// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Properties modal in mod_kalvidres and mod_kalvidassign.
 *
 * @module local_kaltura/properties
 */

define(['jquery'], function($) {
    
    // selectors
    var videoPropertiesModal = "#video_properties_modal";
    var playerDropdown = "#media_prop_player";
    var sizeDropdown = "#media_prop_size";
    var sizeDropdownOptions = sizeDropdown + " option";
    var customSizeInfo = '#custom_size_info';
    var playerWidth = "#width";
    var playerHeight = "#height";
    var mediaPropWidth = "#media_prop_width";
    var mediaPropHeight = "#media_prop_height";
    var submitButton = "#prop_submit_btn";

    function init() {
        $(videoPropertiesModal).on('show.bs.modal', loadProperties);
        $(sizeDropdown).change(changeSize);
        $(mediaPropHeight).change(dimensionChange);
        $(mediaPropWidth).change(dimensionChange);
        $(submitButton).click(submit);
    }

    function loadProperties() {
        var uiconfid = $("#uiconf_id").val();
        var selectedPlayerIndex = $(playerDropdown + ' option[value="' + uiconfid + '"]').index();
        var width = $(playerWidth).val();
        var height = $(playerHeight).val();
        var dimension = width + 'x' + height;

        $(playerDropdown).prop("selected", selectedPlayerIndex);
        $(customSizeInfo).css('display', 'none');

        if (width !== "" && width != "0" && height !== "" && height != "0") {

            for (var i = 0; i < $(sizeDropdownOptions).length; i++) {
                if ($(sizeDropdownOptions)[i].text.indexOf(dimension) != -1) {
                    $(sizeDropdown).prop("selectedIndex", i);
                    $(mediaPropWidth).prop("disabled", true);
                    $(mediaPropHeight).prop("disabled", true);
                }
            }

            if ($(mediaPropWidth).prop("disabled") === false) {
                $(sizeDropdown).prop("selectedIndex", $(sizeDropdownOptions).length - 1);
                $(mediaPropWidth).val(width);
                $(mediaPropHeight).val(height);
            }
        }

    }

    function changeSize() {
        var index = $(sizeDropdown).prop("selectedIndex");
        
        if (index == $(sizeDropdownOptions).length - 1) {
            $(customSizeInfo).css('display', 'inherit');
            $(customSizeInfo).removeClass('text-danger');
            $(customSizeInfo).addClass('text-muted');
            $(mediaPropWidth).prop("disabled", false);
            $(mediaPropHeight).prop("disabled", false);
            $(submitButton).prop("disabled", true);

        }
        else {
            $(customSizeInfo).css('display', 'none');
            $(mediaPropWidth).prop("disabled", true);
            $(mediaPropHeight).prop("disabled", true);
            $(mediaPropWidth).val("");
            $(mediaPropHeight).val("");
            $(submitButton).prop("disabled", false);
        }
    }

    function dimensionChange() {
        var flag = false;
        var widthStr = $(mediaPropWidth).val();
        var heightStr = $(mediaPropHeight).val();
        var regex = /^\d{2,4}$/;

        if (regex.test(widthStr) === true && regex.test(heightStr) === true) {
            var widthInt = parseInt(widthStr);
            var heightInt = parseInt(heightStr);
            flag = checkPlayerDimension(widthInt, heightInt);
        }

        if (flag === true) {
            $(submitButton).prop('disabled', false);
            $(customSizeInfo).removeClass('text-danger');
            $(customSizeInfo).addClass('text-muted');
        } 
        else {
            $(submitButton).prop('disabled', true);
            $(customSizeInfo).removeClass('text-muted');
            $(customSizeInfo).addClass('text-danger');
        }
    }

    function checkPlayerDimension(width, height) {
        if (width < 200 || height < 200) {
            return false;
        } 
        else if (width > 1280 || height > 1280) {
            return false;
        }

        return true;
    }

    function submit() {
        var width = "";
        var height = "";

        if ($(sizeDropdown).prop("selectedIndex") === $(sizeDropdownOptions).length - 1) {
            if ($(mediaPropWidth).val() === "" || $(mediaPropHeight).val() === "") {
                return;
            }
            else {
                width = $(mediaPropWidth).val().trim();
                height = $(mediaPropHeight).val().trim();
                var regex = /^\d{2,4}$/;
                if (regex.test(width) === false || regex.test(height) === false) {
                    return;
                }
            }
        }
        else {
            var dimension = $(sizeDropdown + " option:selected").text();
            var dimensionArray = dimension.match(/\d{2,4}/g);
            width = dimensionArray[0];
            height = dimensionArray[1];
        }

        if (checkPlayerDimension(parseInt(width), parseInt(height)) === false) {
            return;
        }

        $(playerWidth).val(width);
        $(playerHeight).val(height);
        $("#uiconfid").val($(playerDropdown).val());
        $(videoPropertiesModal).modal("hide");
    }

    return {init : init};
});