<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'categories.index',
           'categories.create',
           'categories.edit',
           'categories.destroy',
           'audio-contents.index',
           'audio-contents.create',
           'audio-contents.edit',
           'audio-contents.destroy',
           'video-contents.index',
           'video-contents.create',
           'video-contents.edit',
           'video-contents.destroy',
           'wallpaper-contents.index',
           'wallpaper-contents.create',
           'wallpaper-contents.edit',
           'wallpaper-contents.destroy',
           'text-contents.index',
           'text-contents.create',
           'text-contents.edit',
           'text-contents.destroy',
           'allah-name.index',
           'allah-name.create',
           'allah-name.edit',
           'allah-name.destroy',
           'subscriptions.index',
           'subscriptions.create',
           'subscriptions.edit',
           'subscriptions.destroy',
           'common-page.index',
           'common-page.create',
           'common-page.edit',
           'common-page.destroy',
           'prayer-times.index',
           'prayer-times.create',
           'prayer-times.edit',
           'prayer-times.destroy',
           'permissions.index',
           'permissions.create',
           'permissions.edit',
           'permissions.destroy',
           
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
