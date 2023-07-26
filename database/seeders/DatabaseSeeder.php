<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\News;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Agenda;
use App\Models\TemaPortal;
use App\Models\TemaDashboard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = (string) Uuid::uuid4();
        User::create([
            'id' => $admin,
            'name' => 'admin',
            'birthdate' => '2000-02-07',
            'no_induk' => '0',
            'no_hp' => '0812',
            'username' => 'admin',
            'address' => 'subang',
            'major' => 'mi',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'isRegistered' => 1
        ]);

        User::create([
            'id' => (string) Uuid::uuid4(),
            'name' => 'galih',
            'birthdate' => '2000-01-01',
            'no_induk' => '2983912',
            'no_hp' => '0818',
            'username' => 'galih',
            'address' => 'subang',
            'major' => 'mi',
            'role' => 'mahasiswa',
            'email' => 'galih@gmail.com',
            'password' => Hash::make('galih'),
        ]);

        /**
         * UserDosen
         */

        // User::create([
        //     'name' => 'Nunu Nugraha Purnawan, S.Pd., M.Kom.',
        //     'birthdate' => '1979-09-15',
        //     'no_induk' => '197909152015041000',
        //     'no_hp' => '0813',
        //     'username' => 'nunu',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'dosen',
        //     'email' => 'nunu@gmail.com',
        //     'password' => Hash::make('nunu'),
        // ]);

        // User::create([
        //     'name' => 'Tri Herdiawan Apandi, S.ST., M.T.',
        //     'birthdate' => '1988-01-05',
        //     'no_induk' => '198801052019031008',
        //     'no_hp' => '0814',
        //     'username' => 'tri',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'dosen',
        //     'email' => 'tri@gmail.com',
        //     'password' => Hash::make('tri'),
        // ]);

        // User::create([
        //     'name' => 'Mohammad Iqbal S.Kom., M.T.',
        //     'birthdate' => '1990-01-26',
        //     'no_induk' => '199001262019031025',
        //     'no_hp' => '0815',
        //     'username' => 'iqbal',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'dosen',
        //     'email' => 'iqbal@gmail.com',
        //     'password' => Hash::make('iqbal'),
        // ]);

        // User::create([
        //     'name' => 'Dwi Vernanda S.T., M.Pd.',
        //     'birthdate' => '1991-04-30',
        //     'no_induk' => '199104302019032018',
        //     'no_hp' => '0816',
        //     'username' => 'dwi',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'dosen',
        //     'email' => 'dwi@gmail.com',
        //     'password' => Hash::make('dwi'),
        // ]);

        // User::create([
        //     'name' => 'Nurfitria Khoirunnisa, S.Tr.Kom., M.Kom',
        //     'birthdate' => '1996-03-11',
        //     'no_induk' => '199603112020122022',
        //     'no_hp' => '0817',
        //     'username' => 'nur',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'dosen',
        //     'email' => 'nur@gmail.com',
        //     'password' => Hash::make('nur'),
        // ]);

        // /**
        //  * UserMahasiswa
        //  */

        // User::create([
        //     'name' => 'Muhamad Galuh Febrian',
        //     'birthdate' => '2000-07-02',
        //     'no_induk' => '10107039',
        //     'no_hp' => '0818',
        //     'username' => 'galuh',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'mahasiswa',
        //     'email' => 'mgfebrian@gmail.com',
        //     'password' => Hash::make('galuh'),
        // ]);

        // /**
        //  * UserStaff
        //  */

        // User::create([
        //     'name' => 'Syifa Rizkita Ananda, A.md.Kom',
        //     'birthdate' => '1998-12-26',
        //     'no_induk' => '210300082',
        //     'no_hp' => '0819',
        //     'username' => 'syifa',
        //     'address' => 'subang',
        //     'major' => 'mi',
        //     'role' => 'staff',
        //     'email' => 'syifa@gmail.com',
        //     'password' => Hash::make('syifa'),
        // ]);

        News::create([
            'id' => (string) Uuid::uuid4(),
            'user_id' => $admin,
            'query' => null,
            'country' => 'us',
            'category' => 'technology',
            'page_size' => 3,
        ]);

        TemaPortal::create([
            'id' => (string) Uuid::uuid4(),
            'user_id' => $admin,
            'cover_main' => NULL,
            'bg_main' => '#4e73df',
            'layout_main' => '#ffffff',
            'color_main' => '#3a3b45',
            'button_primary' => '#4E73DF',
            'button_color_primary' => '#ffffff',
        ]);

        TemaDashboard::create([
            'id' => (string) Uuid::uuid4(),
            'user_Id' => $admin,
            'bg_sidebar' => '#4e73df',
            'color_sidebar' => '#ffffcc',
            'bg_sidebar_active' => 'black',
            'bg_navbar' => '#ffffff',
            'color_navbar' => '#858796',
            'bg_footer' => '#f8f8f8',
            'color_footer' => '#858796',
            'bg_content' => '#f8f8f8',
            'color_content' => '#5a5c69',
            'bg_primary' => '#4e73df',
            'color_primary' => '#ffffff',
            'bg_secondary' => '#858796',
            'color_secondary' => '#ffffff',
        ]);

        Agenda::create([
            'id' => (string) Uuid::uuid4(),
            'user_id' => $admin,
            'start' => '2023-05-22T10:00:00',
            'end' => '2023-05-23T11:00:00',
            'title' => 'Hari Normal',
            'description' => 'Hari hari yang sangat normal',
            'location' => 'Gedung JMI',
            'backgroundColor' => 'green',
            'borderColor' => 'black',
            'textColor' => 'white',
        ]);
    }
}
