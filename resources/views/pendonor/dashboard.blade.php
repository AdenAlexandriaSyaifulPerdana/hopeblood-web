<div style="
    max-width: 720px;
    margin: 55px auto;
    background: linear-gradient(145deg, #ffe8e5, #ffd4ce);
    padding: 42px;
    border-radius: 28px;
    box-shadow: 0 10px 40px rgba(255,120,120,0.25);
    border: 1px solid #ffdad4;
    font-family: 'Poppins', 'Segoe UI', sans-serif;
">

    {{-- Header --}}
    <h2 style="
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 18px;
        color: #d9383b;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 6px rgba(255,80,80,0.25);
    ">
        Dashboard Pendonor
    </h2>

    <p style="
        font-size: 18px;
        margin-bottom: 32px;
        color: #6e2222;
        line-height: 1.6;
        font-weight: 500;
    ">
        Halo, <strong style="color:#b31c1c">{{ Auth::user()->name }}</strong> 👋
        <br>Terima kasih telah menjadi bagian dari penyelamat nyawa ❤️
    </p>

    {{-- Menu Buttons --}}
    <div style="display: flex; flex-direction: column; gap: 22px;">

        {{-- Tombol Permintaan Darah --}}
        <a href="{{ route('pendonor.permintaan') }}"
            style="
                padding: 18px 22px;
                background: linear-gradient(150deg, #ff6b6b, #ff3b3b);
                color: white;
                font-size: 18px;
                border-radius: 18px;
                text-align: center;
                text-decoration: none;
                font-weight: 700;
                box-shadow: 0 8px 25px rgba(255,70,70,0.35);
                transition: 0.3s ease;
                display: block;
            "
            onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 30px rgba(255,70,70,0.45)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(255,70,70,0.35)'">
            🔍 Lihat Permintaan Darah
        </a>

        {{-- Tombol Riwayat
        <div style="
                padding: 18px 22px;
                background: #ff8c8c;
                color: white;
                font-size: 18px;
                border-radius: 18px;
                text-align: center;
                font-weight: 600;
                opacity: 0.6;
                cursor: not-allowed;
                box-shadow: 0 6px 20px rgba(255,140,140,0.25);
            ">
            🕒 Riwayat Konfirmasi Donor
            <span style="font-size:14px;">(Coming Soon)</span>
        </div> --}}

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                style="
                    width: 100%;
                    padding: 18px 22px;
                    background: #ffb4a8;
                    color: #7a2323;
                    border: none;
                    border-radius: 18px;
                    cursor: pointer;
                    font-size: 18px;
                    font-weight: 700;
                    box-shadow: 0 6px 20px rgba(255,180,168,0.4);
                    transition: 0.3s ease;
                "
                onmouseover="this.style.background='#ff9e90'; this.style.transform='translateY(-3px)'"
                onmouseout="this.style.background='#ffb4a8'; this.style.transform='translateY(0)'">
                Logout
            </button>
        </form>

    </div>

</div>
