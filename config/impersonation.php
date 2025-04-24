<?php

return [
    /**
     * Whether to enable this package or not.
     */
    'enabled' => true,


    /**
     * Roles that can impersonate as other users when using default policy trait.
     *
     * Note: this is used by the trait this package provide, so if the impersonation logic is
     * implemented by yourself, this might have no use.
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
];
