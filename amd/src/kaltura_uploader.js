define(['jquery'], function($) {

    var upload = function(uploadData, kalturaData, progressCallback) {
        var uploadTokenId;
        var entryId;
        return createUploadToken(uploadData, kalturaData)
        .then(function(xml) {
            const error = $(xml).find('error');
            if (error.length) {
                throw new Error($(xml).find('error').find('message').text());
            }
            uploadTokenId = $(xml).find('id').text();
            return createMediaEntry(uploadData, kalturaData);
        })
        .then(function(xml) {
            const error = $(xml).find('error');
            if (error.length) {
                throw new Error($(xml).find('error').find('message').text());
            }
            entryId = $(xml).find('id').text();
            return uploadMediaFile(uploadData, kalturaData, uploadTokenId, progressCallback);
        })
        .then(function(xml) {
            const error = $(xml).find('error');
            if (error.length) {
                throw new Error($(xml).find('error').find('message').text());
            }
            return attachUploadedFile(kalturaData, entryId, uploadTokenId);
        })
        .then(function(xml) {
            const error = $(xml).find('error');
            if (error.length) {
                throw new Error($(xml).find('error').find('message').text());
            }
            return attachCustomMetadata(kalturaData, uploadData, entryId);
        })
        .then(function(xml) {
            const error = $(xml).find('error');
            if (error.length) {
                throw new Error($(xml).find('error').find('message').text());
            }
            return addToCategory(kalturaData, entryId);
        });
    };

    var createUploadToken = function(uploadData, kalturaData) {
        var fileSize = parseInt(encodeURI(uploadData.file.size));
        var postData = {
            type: "GET",
            cache: false,
            async: true,
            contentType: false,
            scriptCharset: "utf-8",
            dataType: "xml"
        };
        var serviceURL = kalturaData.serverhost + "/api_v3/service/uploadToken/action/add?ks=" + kalturaData.ks;
        serviceURL += "&uploadToken:objectType=KalturaUploadToken";
        serviceURL += "uploadToken:fileName=" + encodeURI(uploadData.file.name);
        serviceURL += "&uploadToken:fileSize=" + fileSize;
        serviceURL += "&uploadToken:autoFinalize=-1";

        return $.ajax(serviceURL, postData);
    };

    var createMediaEntry = function(uploadData, kalturaData) {
        var data = new FormData();
        data.append("action", "add");
        data.append("ks", kalturaData.ks);
        data.append("entry:objectType", "KalturaMediaEntry");
        data.append("entry:mediaType", 1);
        data.append("entry:sourceType", 1);
        data.append("entry:name", uploadData.name);
        data.append("entry:tags", uploadData.tags);
        data.append("entry:description", uploadData.desc);
        data.append("entry:creatorId", kalturaData.creatorid);
        data.append("entry:userId", kalturaData.creatorid);

        var postData = {
            type: "POST",
            data: data,
            cache: false,
            async: true,
            contentType: false,
            scriptCharset: "utf-8",
            processData: false,
            dataType: "xml"
        };
        var serviceURL = kalturaData.serverhost + "/api_v3/service/media/action/add";
        return $.ajax(serviceURL, postData);
    };

    var uploadMediaFile = function(uploadData, kalturaData, uploadTokenId, progressCallback) {
        var fd = new FormData();
        fd.append("action", "upload");
        fd.append("ks", kalturaData.ks);
        fd.append("uploadTokenId", uploadTokenId);
        fd.append("fileData", uploadData.file, encodeURI(uploadData.file.name), uploadData.file.size);
        fd.append("resume", false);
        fd.append("finalChunk", true);
        fd.append("resumeAt", 0);

        var postData = {
            type: "POST",
            data: fd,
            cache: false,
            async: true,
            contentType: false,
            scriptCharset: "utf-8",
            processData: false,
            dataType: "xml",
            xhr: function() {
                var XHR = $.ajaxSettings.xhr();
                if (XHR.upload) {
                    XHR.upload.addEventListener("progress", progressCallback, false);
                }
                return XHR;
            }
        };
        var serviceURL = kalturaData.serverhost + "/api_v3/service/uploadToken/action/upload";
        return $.ajax(serviceURL, postData);
    };

    var attachUploadedFile = function(kalturaData, entryId, uploadTokenId) {
        var fd = new FormData();
        fd.append("action", "addContent");
        fd.append("ks", kalturaData.ks);
        fd.append("entryId", entryId);
        fd.append("resource:objectType", "KalturaUploadedFileTokenResource");
        fd.append("resource:token", uploadTokenId);

        var postData = {
            type: "POST",
            data: fd,
            cache: false,
            async: true,
            contentType: false,
            scriptCharset: "utf-8",
            processData: false,
            dataType: "xml"
        };
        var serviceURL = kalturaData.serverhost + "/api_v3/service/media/action/addContent";
        return $.ajax(serviceURL, postData);
    };

    var addToCategory = function(kalturaData, entryId) {
        var fd = new FormData();
        fd.append('ks', kalturaData.ks);
        fd.append("categoryEntry:objectType", "KalturaCategoryEntry");
        fd.append('categoryEntry:categoryId', kalturaData.categoryid);
        fd.append('categoryEntry:entryId', entryId);

        var postData = {
            type: "POST",
            data: fd,
            cache: false,
            async: true,
            contentType: false,
            scriptCharset: "utf-8",
            processData: false,
            dataType: "xml"
        };
        var serviceURL = kalturaData.serverhost + "/api_v3/service/categoryentry/action/add";
        return $.ajax(serviceURL, postData);
    };

    var attachCustomMetadata = function(kalturaData, uploadData, entryId) {
        var fd = new FormData();
        fd.append("action", "add");
        fd.append("ks", kalturaData.ks);
        fd.append("metadataProfileId", kalturaData.metadataid);
        fd.append("objectType", '1');
        fd.append("objectId", entryId);
        fd.append("xmlData", `<metadata>
            <StoreMedia>${uploadData.term}</StoreMedia>
            <StudentContent>${uploadData.studentContent}</StudentContent>
            <Assessment>${uploadData.assessment}</Assessment>
            </metadata>`);
        var postData = {
            type: "POST",
            data: fd,
            cache: false,
            async: true,
            contentType: false,
            scriptCharset: "utf-8",
            processData: false,
            dataType: "xml"
        };
        var serviceURL = kalturaData.serverhost + "/api_v3/service/metadata_metadata/action/add";
        return  $.ajax(serviceURL, postData);
    };

    return {
        upload: upload
    };

});
