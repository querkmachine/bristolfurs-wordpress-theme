<?php

function bf_menus()
{
	$locations = [
		"primary" => __("Primary Navigation", "bristolfurs"),
		"footer" => __("Footer Menu", "bristolfurs"),
	];
	register_nav_menus($locations);
}

add_action("init", "bf_menus");
