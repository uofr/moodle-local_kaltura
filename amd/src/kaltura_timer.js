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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>

let timer = null;
let interval = 1000;
let startTime = 0;

const startTimer = (method) => {
    if (timer) return;
    startTime = Date.now();
    timer = setInterval(() => {
        method();
    }, interval);
};

const stopTimer = () => {
    if (!timer) return;
    clearInterval(timer);
    timer = null;
};

const getTime = () => {
    const elapsedTime = new Date(Date.now() - startTime);
    const minutesElapsedStr = `${elapsedTime.getMinutes()}`.padStart(2, '0');
    const secondsElapsedStr = `${elapsedTime.getSeconds()}`.padStart(2, '0');
    return `${minutesElapsedStr}:${secondsElapsedStr}`;
};

export default {
    startTimer: startTimer,
    stopTimer: stopTimer,
    getTime: getTime
};