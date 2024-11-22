<?php

return [
    /**
     * Whether to enable this package or not.
     */
    'enabled' => true,


    /**
     * Roles that can impersonate as other users.
     *
     * Note: this might have no use if `policy` is provided.
     */
    'impersonable_roles' => ['admin'],


    /**
     * The path to redirect to after impersonation.
     */
    'post_impersonation_route' => '/',


    /**
     * The columns that are going to be displayed on the table.
     *
     * If left empty, it will show all columns.
     */
    'display_columns' => [
        //
    ],


    /**
     * The impersonation policy to override.
     *
     * Refer to README.md to see how to implement.
     */
    // 'policy' => App\Policies\ImpersonationPolicy::class,
];
