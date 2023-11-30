Nama        : Annisa Nur Kholifah Suryaningrum
NIM         : 2204943
Kelas       : 3B PSTI
MataKuliah  : Pemrograman Internet


1. Migration
    Migration pada Laravel merupakan sebuah fitur yang dapat membantu kita mengelola database secara efisien dengan menggunakan kode. 
Migration membantu kita dalam membuat (create), mengubah (edit), dan menghapus (delete) struktur tabel dan kolom pada database milik kita dengan cepat dan mudah.
Berikut adalah perintah-perintah terkait migration pada Laravel:
1. Membuat Migration
	php artisan make:migration create_student_table
2. Menjalankan Migration 
	php artisan migrate
contoh migration yang telah dibuat:
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};

2. Seeder
Seeder pada Laravel merupakan merupakan sebuah class yang memungkinkan kita sebagai web developer 
untuk mengisi database kita dengan data awal atau dummy data yang telah ditentukan secara otomatis. 
Seeder memungkinkan kita untuk membuat data awal yang sama untuk setiap penggunaan dalam pembangunan aplikasi
perintah-perintah dasar terkait seeder sebagai berikut:
1. Membuat Seeder
	php artisan make:seeder StudentSeeder
2. Menjalankan Seeder
	php artisan db:seed --class=StudentSeeder

Berikut adalah contoh seeder yang pernah saya Buat:
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Tambahkan impor Faker

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //$data = [
            //['id'=> 1, 'name'=> 'annisa', 'score' => 100],
            //['id'=> 2, 'name'=> 'nur', 'score' => 90],
            //['id'=> 3, 'name'=> 'kholifah', 'score' => 95],
        //];
        
        $data = [];
        $faker = Faker::create();

        for ($i = 3; $i < 50; $i++) {
            $data[] = [
                'id' => $i + 1,
                'name'  => $faker->name,
                'score' => rand(30, 100),
            ];
        }

        DB::table('student')->insert($data);
    }
}

3. Laravel Mvc Framework
MVC adalah sebuah pendekatan perangkat lunak yang memisahkan aplikasi logika dari presentasi. 
MVC memisahkan aplikasi berdasarkan komponen- komponen aplikasi, seperti : manipulasi data, controller, dan user interface.
Berikut adalah konsep dasar dari MVC dalam konteks laravel:
1. Model yaitu yang mewakili struktur data. Biasanya model berisi fungsi-fungsi yang membantu seseorang dalam pengelolaan basis data seperti memasukkan data ke basis data, pembaruan data dan lain-lain.
- cara membuat Model
	php artisan make:model
- contoh model
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
}
2. View adalah bagian yang mengatur tampilan ke pengguna. Bisa dikatakan berupa halaman web.
- Contoh Views yang telah dibuat
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Hi, {{$name}}!</p>
</body>
</html>

3. Controller merupakan bagian yang menjembatani model dan view.
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;

class StudentController extends Controller
{

    public function show($id){
        $name = Student::find($id)->name;
        return view("example", ['name'=> $name]);
    }
}

Untuk menjalankan migration,seeder dan lain-lainnya menggunakan terminal.