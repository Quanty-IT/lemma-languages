<h1 align="center" style="font-weight: bold;">Lemma Languages 🇧🇷🇺🇸</h1>

<p align="center">
 <a href="#technologies">Technologies</a> • 
 <a href="#description">Description</a> • 
 <a href="#requirements">Requirements</a> • 
 <a href="#installation">Installation</a> •
 <a href="#commands">Commands</a> •
 <a href="#extensions">Extensions</a> •
 <a href="#collaborators">Collaborators</a>
</p>

<h2 id="technologies">💻 Technologies</h2>

![Static Badge](https://img.shields.io/badge/php%20-%20%23777BB4?style=for-the-badge&logo=php&color=%23000000) ![Static Badge](https://img.shields.io/badge/laravel%20-%20%23FF2D20?style=for-the-badge&logo=laravel&color=%23000000) ![Static Badge](https://img.shields.io/badge/sqlite%20-%20%23003B57?style=for-the-badge&logo=sqlite&logoColor=%23003B57&color=%23000000)

<h2 id="description">📚 Description</h2>

The <strong>Lemma Languages</strong> project is a management system designed for language schools. It provides a full interface for administrators to control students, teachers, and their interactions over the months.

<b>Main features:</b>
<ul>
  <li>Register, update, list and delete teachers and students;</li>
  <li>Each registered teacher receives login access to the system;</li>
  <li>Teachers can monthly submit:
    <ul>
      <li>The total class hours given per student;</li>
      <li>The content covered in each session.</li>
    </ul>
  </li>
  <li>The admin dashboard gets automatically updated with:
    <ul>
      <li>The total amount paid to each teacher (considering all their students);</li>
      <li>The financial breakdown: how much stays with the teacher (e.g. 70%) and how much goes to the school (e.g. 30%).</li>
    </ul>
  </li>
</ul>

<b>Relationship model:</b>
<ul>
  <li>Each student is linked to a single teacher;</li>
  <li>Each teacher can be responsible for multiple students.</li>
</ul>

<h2 id="requirements">📋 Requirements</h2>

- PHP
- Composer

<h2 id="installation">⚙️ Installation</h2>

- 1: Clone this repository: `git clone https://github.com/Quanty-IT/lemma-languages.git`;
- 2: Create a `.env` file from the `.env.example` file;
- 3: Fill in all the necessary variables in the `.env`;
- 4: Install the dependencies, running the command: `composer install`;
- 5: Run the migrations, running the command: `php artisan migrate`;
- 6: Run the application, running the command: `php artisan serve`

<h2 id="commands">💡 Useful Commands</h2>

<ul>
  <li>Create a new view: <code>php artisan make:view name-here</code></li>
  <li>Create a new controller: <code>php artisan make:controller NameHereController</code></li>
  <li>Create a new model: <code>php artisan make:model NameHere</code></li>
  <li>Create a new migration: <code>php artisan make:migration create_table_name_here</code></li>
  <li>Run the migrations: <code>php artisan migrate</code></li>
  <li>Rollback the last migration: <code>php artisan migrate:rollback</code></li>
</ul>

<h2 id="extensions">🔌 Recommended Extensions</h2>

<ul>
  <li>
    <strong><a href="https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client">PHP Intelephense</a></strong> — Powerful IntelliSense, autocompletion and validation for PHP
  </li>
  <li>
    <strong><a href="https://marketplace.visualstudio.com/items?itemName=shufo.vscode-blade-formatter">Laravel Blade Formatter</a></strong> — Automatically formats Blade files (.blade.php)
  </li>
  <li>
    <strong><a href="https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade">Laravel Blade Snippets</a></strong> — Useful snippets to speed up Blade development
  </li>
  <li>
    <strong><a href="https://marketplace.visualstudio.com/items?itemName=alexcvzz.vscode-sqlite">SQLite Viewer</a></strong> — View and edit the SQLite database directly from VS Code
  </li>
</ul>

<h2 id="collaborators">🤝 Collaborators</h2>

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/victorozoterio">
        <img src="https://avatars.githubusercontent.com/u/165734095?v=4" width="100px;" alt="Victor Ozoterio Profile Picture"/><br>
        <sub>
          <a href="https://github.com/victorozoterio">
          Victor Ozoterio</a>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/Murilocampoos">
        <img src="https://avatars.githubusercontent.com/u/95322404?v=4" width="100px;" alt="Murilo Campos Profile Picture"/><br>
        <sub>
          <a href="https://github.com/Murilocampoos">
          Murilo Campos</a>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/bds-dat">
        <img src="https://avatars.githubusercontent.com/u/200520493?v=4" width="100px;" alt="Bianca Disanti Profile Picture"/><br>
        <sub>
          <a href="https://github.com/bds-dat">
          Bianca Disanti</a>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/PedroHDenny">
        <img src="https://avatars.githubusercontent.com/u/130395012?v=4" width="100px;" alt="Pedro Denny Profile Picture"/><br>
        <sub>
          <a href="https://github.com/PedroHDenny">
          Pedro Denny</a>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/MarceloASandy">
        <img src="https://avatars.githubusercontent.com/u/178934793?v=4" width="100px;" alt="Marcelo Sandy Profile Picture"/><br>
        <sub>
          <a href="https://github.com/MarceloASandy">
          Marcelo Sandy</a>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/marlon-greg">
        <img src="https://avatars.githubusercontent.com/u/128714421?v=4" width="100px;" alt="Marlon Fanger Profile Picture"/><br>
        <sub>
          <a href="https://github.com/marlon-greg">
          Marlon Fanger</a>
        </sub>
      </a>
    </td>
  </tr>
</table>
