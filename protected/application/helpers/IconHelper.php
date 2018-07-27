<?php
namespace application\helpers;

class IconHelper
{
    private static $_icons = [
        'cancel' => '<svg class="glyph stroked"><use xlink:href="#stroked-cancel"></use></svg>',
        'calendar' => '<svg class="glyph stroked"><use xlink:href="#stroked-calendar"></use></svg>',
        'coffee-cup' => '<svg class="glyph stroked"><use xlink:href="#stroked-paper-coffee-cup"></use></svg>',
        'burger' => '<svg class="glyph stroked"><use xlink:href="#stroked-bacon-burger"></use></svg>',
        'coffee-mug' => '<svg class="glyph stroked"><use xlink:href="#stroked-round-coffee-mug"></use></svg>',
        'router' => '<svg class="glyph stroked"><use xlink:href="#stroked-wireless-router"></use></svg>',
        'pen-tip' => '<svg class="glyph stroked"><use xlink:href="#stroked-pen-tip"></use></svg>',
        'flash-drive' => '<svg class="glyph stroked"><use xlink:href="#stroked-usb-flash-drive"></use></svg>',
        'toiler-paper' => '<svg class="glyph stroked"><use xlink:href="#stroked-toiler-paper"></use></svg>',
        'pencil' => '<svg class="glyph stroked"><use xlink:href="#stroked-pencil"></use></svg>',
        'brush' => '<svg class="glyph stroked"><use xlink:href="#stroked-brush"></use></svg>',
        'email' => '<svg class="glyph stroked"><use xlink:href="#stroked-email"></use></svg>',
        'open-letter' => '<svg class="glyph stroked"><use xlink:href="#stroked-open-letter"></use></svg>',
        'computer' => '<svg class="glyph stroked"><use xlink:href="#stroked-laptop-computer-and-mobile"></use></svg>',
        'hourglass' => '<svg class="glyph stroked"><use xlink:href="#stroked-hourglass"></use></svg>',
        'internal-hard-drive' => '<svg class="glyph stroked"><use xlink:href="#stroked-internal-hard-drive"></use></svg>',
        'external-hard-drive' => '<svg class="glyph stroked"><use xlink:href="#stroked-external-hard-drive"></use></svg>',
        'flag' => '<svg class="glyph stroked"><use xlink:href="#stroked-flag"></use></svg>',
        'desktop-computer' => '<svg class="glyph stroked"><use xlink:href="#stroked-desktop-computer-and-mobile"></use></svg>',
        'database' => '<svg class="glyph stroked"><use xlink:href="#stroked-database"></use></svg>',
        'hand-cursor' => '<svg class="glyph stroked"><use xlink:href="#stroked-hand-cursor"></use></svg>',
        'arrow-cursor' => '<svg class="glyph stroked"><use xlink:href="#stroked-arrow-cursor"></use></svg>',
        'chevron-up' => '<svg class="glyph stroked"><use xlink:href="#stroked-chevron-up"></use></svg>',
        'chevron-right' => '<svg class="glyph stroked"><use xlink:href="#stroked-chevron-right"></use></svg>',
        'chevron-left' => '<svg class="glyph stroked"><use xlink:href="#stroked-chevron-left"></use></svg>',
        'chevron-down' => '<svg class="glyph stroked"><use xlink:href="#stroked-chevron-down"></use></svg>',
        'arrow-up' => '<svg class="glyph stroked"><use xlink:href="#stroked-arrow-up"></use></svg>',
        'arrow-right' => '<svg class="glyph stroked"><use xlink:href="#stroked-arrow-right"></use></svg>',
        'arrow-left' => '<svg class="glyph stroked"><use xlink:href="#stroked-arrow-left"></use></svg>',
        'arrow-down' => '<svg class="glyph stroked"><use xlink:href="#stroked-arrow-down"></use></svg>',
        'video' => '<svg class="glyph stroked"><use xlink:href="#stroked-video"></use></svg>',
        'female' => '<svg class="glyph stroked"><use xlink:href="#stroked-female-user"></use></svg>',
        'film' => '<svg class="glyph stroked"><use xlink:href="#stroked-film"></use></svg>',
        'male' => '<svg class="glyph stroked"><use xlink:href="#stroked-male-user"></use></svg>',
        'upload' => '<svg class="glyph stroked"><use xlink:href="#stroked-upload"></use></svg>',
        'monitor' => '<svg class="glyph stroked"><use xlink:href="#stroked-monitor"></use></svg>',
        'trash' => '<svg class="glyph stroked"><use xlink:href="#stroked-trash"></use></svg>',
        'graph' => '<svg class="glyph stroked"><use xlink:href="#stroked-line-graph"></use></svg>',
        'tag' => '<svg class="glyph stroked"><use xlink:href="#stroked-tag"></use></svg>',
        'tablet' => '<svg class="glyph stroked"><use xlink:href="#stroked-tablet-1"></use></svg>',
        'table' => '<svg class="glyph stroked"><use xlink:href="#stroked-table"></use></svg>',
        'star' => '<svg class="glyph stroked"><use xlink:href="#stroked-star"></use></svg>',
        'sound' => '<svg class="glyph stroked"><use xlink:href="#stroked-sound-on"></use></svg>',
        'printer' => '<svg class="glyph stroked"><use xlink:href="#stroked-printer"></use></svg>',
        'plus' => '<svg class="glyph stroked"><use xlink:href="#stroked-plus-sign"></use></svg>',
        'landscape' => '<svg class="glyph stroked"><use xlink:href="#stroked-landscape"></use></svg>',
        'paperclip' => '<svg class="glyph stroked"><use xlink:href="#stroked-paperclip"></use></svg>',
        'notepad' => '<svg class="glyph stroked"><use xlink:href="#stroked-notepad"></use></svg>',
        'music' => '<svg class="glyph stroked"><use xlink:href="#stroked-music"></use></svg>',
        'mobile' => '<svg class="glyph stroked"><use xlink:href="#stroked-mobile-device"></use></svg>',
        'messages' => '<svg class="glyph stroked"><use xlink:href="#stroked-two-messages"></use></svg>',
        'message' => '<svg class="glyph stroked"><use xlink:href="#stroked-empty-message"></use></svg>',
        'map' => '<svg class="glyph stroked"><use xlink:href="#stroked-map"></use></svg>',
        'lock' => '<svg class="glyph stroked"><use xlink:href="#stroked-lock"></use></svg>',
        'pin' => '<svg class="glyph stroked"><use xlink:href="#stroked-location-pin"></use></svg>',
        'chain' => '<svg class="glyph stroked"><use xlink:href="#stroked-chain"></use></svg>',
        'key' => '<svg class="glyph stroked"><use xlink:href="#stroked-key"></use></svg>',
        'heart' => '<svg class="glyph stroked"><use xlink:href="#stroked-heart"></use></svg>',
        'home' => '<svg class="glyph stroked"><use xlink:href="#stroked-home"></use></svg>',
        'gear' => '<svg class="glyph stroked"><use xlink:href="#stroked-gear"></use></svg>',
        'folder' => '<svg class="glyph stroked"><use xlink:href="#stroked-folder"></use></svg>',
        'open-folder' => '<svg class="glyph stroked"><use xlink:href="#stroked-open-folder"></use></svg>',
        'eye' => '<svg class="glyph stroked"><use xlink:href="#stroked-eye"></use></svg>',
        'download' => '<svg class="glyph stroked"><use xlink:href="#stroked-download"></use></svg>',
        'document' => '<svg class="glyph stroked"><use xlink:href="#stroked-blank-document"></use></svg>',
        'desktop' => '<svg class="glyph stroked"><use xlink:href="#stroked-desktop"></use></svg>',
        'dial' => '<svg class="glyph stroked"><use xlink:href="#stroked-dashboard-dial"></use></svg>',
        'clock' => '<svg class="glyph stroked"><use xlink:href="#stroked-clock"></use></svg>',
        'clipboard' => '<svg class="glyph stroked"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>',
        'checkmark' => '<svg class="glyph stroked"><use xlink:href="#stroked-checkmark"></use></svg>',
        'camcorder' => '<svg class="glyph stroked"><use xlink:href="#stroked-camcorder"></use></svg>',
        'camera' => '<svg class="glyph stroked"><use xlink:href="#stroked-camera"></use></svg>',
        'blank' => '<svg class="glyph stroked"><use xlink:href="#stroked-calendar-blank"></use></svg>',
        'basket' => '<svg class="glyph stroked"><use xlink:href="#stroked-basket"></use></svg>',
        'bag' => '<svg class="glyph stroked"><use xlink:href="#stroked-bag"></use></svg>',
        'window' => '<svg class="glyph stroked"><use xlink:href="#stroked-app-window"></use></svg>',
        'window-content' => '<svg class="glyph stroked"><use xlink:href="#stroked-app-window-with-content"></use></svg>'
    ];
    
    public static function get($alias = null)
    {
        if ($alias === null)
            return self::$_icons;

        if (isset(self::$_icons[$alias]))
            return self::$_icons[$alias];

        return '';
    }
}