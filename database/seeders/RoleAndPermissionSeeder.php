<?php

namespace Database\Seeders;

use App\Constants\Constants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        Permission::create(['name' => Constants::CAN_CREATE_TEACHER]);
        Permission::create(['name' => Constants::CAN_VIEW_TEACHER]);
        Permission::create(['name' => Constants::CAN_EDIT_TEACHER]);
        Permission::create(['name' => Constants::CAN_DELETE_TEACHER]);

        Permission::create(['name' => Constants::CAN_CREATE_EXAMS]);
        Permission::create(['name' => Constants::CAN_VIEW_EXAMS]);
        Permission::create(['name' => Constants::CAN_EDIT_EXAMS]);
        Permission::create(['name' => Constants::CAN_DELETE_EXAMS]);

        Permission::create(['name' => Constants::CAN_CREATE_QUESTIONS]);
        Permission::create(['name' => Constants::CAN_VIEW_QUESTIONS]);
        Permission::create(['name' => Constants::CAN_EDIT_QUESTIONS]);
        Permission::create(['name' => Constants::CAN_DELETE_QUESTIONS]);

        Permission::create(['name' => Constants::CAN_CREATE_OPTIONS]);
        Permission::create(['name' => Constants::CAN_VIEW_OPTIONS]);
        Permission::create(['name' => Constants::CAN_EDIT_OPTIONS]);
        Permission::create(['name' => Constants::CAN_DELETE_OPTIONS]);

        $adminRole = Role::create(['name' => Constants::ROLE_ADMIN]);
        $teacherRole = Role::create(['name' => Constants::ROLE_TEACHER]);
        $studentRole = Role::create(['name' => Constants::ROLE_STUDENT]);

        $adminRole->givePermissionTo([
            Constants::CAN_CREATE_TEACHER,
            Constants::CAN_VIEW_TEACHER,
            Constants::CAN_EDIT_TEACHER,
            Constants::CAN_DELETE_TEACHER,
        ]);

        $teacherRole->givePermissionTo([
            Constants::CAN_CREATE_EXAMS,
            Constants::CAN_VIEW_EXAMS,
            Constants::CAN_EDIT_EXAMS,
            Constants::CAN_DELETE_EXAMS,

            Constants::CAN_CREATE_QUESTIONS,
            Constants::CAN_VIEW_QUESTIONS,
            Constants::CAN_EDIT_QUESTIONS,
            Constants::CAN_DELETE_QUESTIONS,

            Constants::CAN_CREATE_OPTIONS,
            Constants::CAN_VIEW_OPTIONS,
            Constants::CAN_EDIT_OPTIONS,
            Constants::CAN_DELETE_OPTIONS,
        ]);

    }
}
