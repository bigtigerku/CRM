<?php

namespace ChurchCRM\Utils;

use ChurchCRM\dto\SystemURLs;

class RedirectUtils
{
    /**
     * Convert a relative URL into an absolute URL and redirect the browser there.
     *
     * @throws \Exception
     */
    public static function redirect(string $sRelativeURL): void
    {
        if (substr($sRelativeURL, 0, 1) != '/') {
            $sRelativeURL = '/' . $sRelativeURL;
        }
        if (substr($sRelativeURL, 0, strlen(SystemURLs::getRootPath())) != SystemURLs::getRootPath()) {
            $finalLocation = SystemURLs::getRootPath() . $sRelativeURL;
        } else {
            $finalLocation = $sRelativeURL;
        }
        header('Location: ' . $finalLocation);
        exit;
    }

    public static function absoluteRedirect(string $sTargetURL): void
    {
        header('Location: ' . $sTargetURL);
        exit;
    }

    public static function securityRedirect(string $missingRole): void
    {
        LoggerUtils::getAppLogger()->warning('Security Redirect Request due to Role: ' . $missingRole);
        self::Redirect('v2/dashboard');
    }
}
