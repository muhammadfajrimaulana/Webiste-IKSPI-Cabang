<h1>Dashboard Anggota IKSPI</h1>
<p>Selamat Datang, {{ auth()->user()->name }}</p>

<!-- Cek Status sesuai alur diagram -->
@if(auth()->user()->member)
    <div class="alert alert-info">
        Status Verifikasi: <strong>{{ auth()->user()->member->status_verifikasi }}</strong>
    </div>
@else
    <a href="{{ route('member.create') }}" class="btn">Lengkapi Data Pendaftaran</a>
@endif