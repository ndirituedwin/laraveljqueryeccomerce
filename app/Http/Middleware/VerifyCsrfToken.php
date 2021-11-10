<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    // protected $except = [
    //     "/admin/updatecouponstatus",
    //     "/admin/checkcurrentpassword",
    //     "/admin/confirmationofpasswords",
    //     "/admin/updatesectionstatus",
    //     "/admin/updateadmincategories",
    //     "/admin/updatecategorystatu",
    //     "/admin/updatesectionstat",
    //     "/admin/updateproductstatus",
    //         "/admin/updateproductattributestatus",
    //         "/admin/updateimagestatus",
    //         "/admin/updatebrandstatus",
    //         "/admin/updatebannerstatus",
    //         "/admin/updateshippingstatus"
            
    // ];
}
