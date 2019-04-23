'use strict';

var _laravelEcho = require('laravel-echo');

var _laravelEcho2 = _interopRequireDefault(_laravelEcho);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

window.Pusher = require('pusher-js');

Pusher.logToConsole = true;
window.Echo = new _laravelEcho2.default({
    broadcaster: 'pusher',
    key: 'your-pusher-key',
    cluster: 'ap2',
    encrypted: true
});