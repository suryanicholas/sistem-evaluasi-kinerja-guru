<nav class="py-2 h-100 d-flex flex-column gap-2 overflow-y-auto overflow-x-hidden">
    <x-snav active="{{ Request::is('dashboard') }}" href="{{ Request::is('dashboard') ? '#home' : '/dashboard' }}" icon="dashboard">Dashboard</x-snav>
    <x-snav active="{{ Request::is('dashboard/evaluations*') }}" href="{{ route('evaluations.index') }}" icon="assignment">Evaluasi</x-snav>

    <div class="container-fluid mt-3 mb-1 bg-light">Manajemen Data</div>
    <x-snav active="{{ Request::is('dashboard/teachers*') }}" href="{{ route('teachers.index') }}" icon="person">Guru</x-snav>
    <x-snav active="{{ Request::is('dashboard/rooms*') }}" href="{{ route('rooms.index') }}" icon="meeting_room">Kelas</x-snav>
    <x-snav active="{{ Request::is('dashboard/students*') }}" href="{{ route('students.index') }}" icon="groups">Siswa</x-snav>

    @if (Auth::user()->role == 'master')
    <div class="container-fluid mt-3 mb-1 bg-light">Akses Sistem</div>
    <x-snav active="{{ Request::is('dashboard/users') }}" href="{{ route('users.index') }}" icon="badge">Pengguna</x-snav>
    @endif
</nav>