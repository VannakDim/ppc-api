<?php

function is_demo()
{
    $var = false;
    if ($var) {
        return '<div class="col-md-12">
	                <ol class="breadcrumb" style="background: #f39c12;">
		                <p class="text-center" style="color: #fff;"><i class="fa fa-warning"></i> Some feature are disabled in demo mode.</p>
	                </ol>
                </div>';
    }
    return '';
}

function is_demo_admin()
{
    $var = false;
    if ($var) {
        return '<div class="row"><div class="col-md-12">
	                <ol class="breadcrumb" style="background: #f39c12; margin: 0px; border-radius: 0px">
		                <p class="text-center" style="color: #fff; margin: 0px"><i class="fa fa-warning"></i> Some feature are disabled in demo mode.</p>
	                </ol>
                </div></div>';
    }
    return null;
}

function get_featured_image_url($var = null)
{
    if ($var != null) {
        return asset('featured_image/' . $var . '');
    } else {
        return asset('featured_image/');
    }
}

function get_featured_image_path($var = null)
{
    if ($var != null) {
        return public_path('featured_image/' . $var . '');
    } else {
        return public_path('featured_image/');
    }
}

function get_featured_image_thumbnail_url($var = null)
{
    if ($var != null) {
        return asset('featured_image/thumbnail/' . $var . '');
    } else {
        return asset('featured_image/thumbnail/');
    }
}

function get_featured_image_thumbnail_path($var = null)
{
    if ($var != null) {
        return public_path('featured_image/thumbnail/' . $var . '');
    } else {
        return public_path('featured_image/thumbnail/');
    }
}

function get_page_featured_image_url($var = null)
{
    if ($var != null) {
        return asset('page_featured_image/' . $var . '');
    } else {
        return asset('page_featured_image/');
    }
}

function get_page_featured_image_path($var = null)
{
    if ($var != null) {
        return public_path('page_featured_image/' . $var . '');
    } else {
        return public_path('page_featured_image/');
    }
}


function get_gallery_image_url($var = null)
{
    if ($var != null) {
        return asset('gallery_image/' . $var . '');
    } else {
        return asset('gallery_image/');
    }
}

function get_gallery_image_path($var = null)
{
    if ($var != null) {
        return public_path('gallery_image/' . $var . '');
    } else {
        return public_path('gallery_image/');
    }
}

function get_advertisement_image_url($var = null)
{
    if ($var != null) {
        return asset('advertisement_image/' . $var . '');
    } else {
        return asset('advertisement_image/');
    }
}

function get_advertisement_image_path($var = null)
{
    if ($var != null) {
        return public_path('advertisement_image/' . $var . '');
    } else {
        return public_path('advertisement_image/');
    }
}

function get_banner_image_url($var = null)
{
    if ($var != null) {
        return asset('banner_image/' . $var . '');
    } else {
        return asset('banner_image/');
    }
}

function get_banner_image_path($var = null)
{
    if ($var != null) {
        return public_path('banner_image/' . $var . '');
    } else {
        return public_path('banner_image/');
    }
}

function get_member_image_url($var = null)
{
    if ($var != null) {
        return asset('member_image/' . $var . '');
    } else {
        return asset('member_image/');
    }
}

function get_member_image_path($var = null)
{
    if ($var != null) {
        return public_path('member_image/' . $var . '');
    } else {
        return public_path('member_image/');
    }
}

function get_resource_thumbnail_path($var = null)
{
    if ($var != null) {
        return public_path('resource_thumbnail/' . $var . '');
    } else {
        return public_path('resource_thumbnail/');
    }
}

function get_resource_thumbnail_url($var = null)
{
    if ($var != null) {
        return asset('resource_thumbnail/' . $var . '');
    } else {
        return asset('resource_thumbnail/');
    }
}

function get_resource_file_path($var = null)
{
    if ($var != null) {
        return public_path('resource_file/' . $var . '');
    } else {
        return public_path('resource_file/');
    }
}
function get_resource_file_url($var = null)
{
    if ($var != null) {
        return asset('resource_file/' . $var . '');
    } else {
        return asset('resource_file/');
    }
}



function isAdmin()
{
    $user = Auth::user();
    if ($user->role == 'admin') {
        return true;
    } else {
        return false;
    }
}

function isAuthor()
{
    $user = Auth::user();
    if ($user->role_id == 2) {
        return true;
    } else {
        return false;
    }
}

function isUser()
{
    $user = Auth::user();
    if ($user->role == 'user') {
        return true;
    } else {
        return false;
    }
}

function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }

        $url .= ' />';
    }
    return $url;
}