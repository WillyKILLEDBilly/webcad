"use strict";

b4w.register("camera_move_styles", function(exports, require) {

var m_app     = require("app");
var m_cam     = require("camera");
var m_cfg     = require("config");
var m_data    = require("data");
var m_scenes  = require("scenes");
var m_trans   = require("transform");
var m_util    = require("util");
var m_version = require("version");

var DEBUG = (m_version.type() === "DEBUG");





exports.init = function() {
    m_app.init({
        canvas_container_id: "container_id",
        callback: init_cb,
        physics_enabled: false,
        alpha: true,
        show_fps: false,
        autoresize: true,
        assets_dds_available: !DEBUG,
        assets_min50_available: !DEBUG,
        console_verbose: true,
        gl_debug: true,
        force_container_ratio: 2
    });
}

function init_cb(canvas_elem, success) {

    if (!success) {
        console.log("b4w init failure");
        return;
    }
    load();
}

function load() {
    m_data.load( "foo.json", load_cb);
}

function load_cb(data_id) {
	m_app.enable_camera_controls();
}

});
b4w.require("camera_move_styles").init();
