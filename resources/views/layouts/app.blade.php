<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'TaskFlow') | Gestor de tareas</title>

    <style>
        :root {
            --primary: #635bff;
            --primary-dark: #5046e5;
            --background: #f5f6fa;
            --surface: #ffffff;
            --text: #202338;
            --muted: #777b91;
            --border: #e8eaf2;
            --success: #15966a;
            --warning: #d68b13;
            --danger: #d94d64;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--text);
            background: var(--background);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        .app-layout {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 245px;
            flex-shrink: 0;
            padding: 28px 18px;
            background: var(--surface);
            border-right: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 38px 8px;
            font-size: 23px;
            font-weight: 800;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--primary);
            border-radius: 13px;
        }

        .nav-label {
            margin: 0 0 12px 10px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .nav-link {
            display: block;
            margin-bottom: 7px;
            padding: 13px 14px;
            border-radius: 10px;
            color: var(--muted);
            transition: background .2s, color .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
            background: #f0efff;
        }

        .main-area {
            min-width: 0;
            flex: 1;
        }

        .topbar {
            min-height: 78px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 18px 34px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .topbar-title {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
        }

        .topbar-subtitle {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .user-badge {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: var(--primary);
            background: #efedff;
            font-weight: 800;
        }

        .content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 34px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 28px;
        }

        .page-heading h1 {
            margin: 0;
            font-size: clamp(25px, 3vw, 32px);
            letter-spacing: -.8px;
        }

        .page-heading p {
            margin: 8px 0 0;
            color: var(--muted);
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            transition: background .2s, transform .2s;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: white;
            background: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            color: var(--text);
            background: #eceef5;
        }

        .btn-danger {
            color: var(--danger);
            background: #fff0f2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            padding: 23px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .stat-value {
            margin: 15px 0 7px;
            font-size: 32px;
            font-weight: 800;
        }

        .stat-description {
            color: var(--muted);
            font-size: 12px;
        }

        .panel {
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 22px 24px;
            border-bottom: 1px solid var(--border);
        }

        .panel-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th,
        td {
            padding: 17px 22px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        th {
            color: var(--muted);
            background: #fafbfe;
            font-size: 11px;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        td {
            font-size: 13px;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .task-title {
            font-weight: 700;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-pendiente {
            color: #a76a00;
            background: #fff4d9;
        }

        .status-en_progreso {
            color: #5146c8;
            background: #efedff;
        }

        .status-completada {
            color: #087b54;
            background: #e0f7ed;
        }

        .priority-baja {
            color: #087b54;
        }

        .priority-media {
            color: #a76a00;
        }

        .priority-alta {
            color: #d43850;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-link {
            color: var(--primary);
            font-weight: 700;
        }

        .action-button {
            padding: 0;
            border: 0;
            color: var(--danger);
            background: transparent;
            cursor: pointer;
            font-weight: 700;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 15px;
            font-size: 42px;
        }

        .empty-state h3 {
            margin-bottom: 8px;
        }

        .empty-state p {
            margin-bottom: 22px;
            color: var(--muted);
        }

        .form-panel {
            max-width: 850px;
            margin: 0 auto;
            padding: 28px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dfe2ed;
            border-radius: 9px;
            outline: none;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px #635bff18;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 26px;
        }

        .alert {
            margin-bottom: 22px;
            padding: 15px 18px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-success {
            color: #087b54;
            background: #e0f7ed;
        }

        .alert-error {
            color: #a5283d;
            background: #fff0f2;
        }

        .error-text {
            color: var(--danger);
            font-size: 12px;
        }

        .description-text {
            margin-top: 5px;
            color: var(--muted);
            font-size: 12px;
        }

        .footer {
            padding: 22px 34px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 1050px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content {
                padding: 25px;
            }
        }

        @media (max-width: 700px) {
            .app-layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 18px;
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .brand {
                margin: 0 0 18px;
            }

            .nav-label {
                display: none;
            }

            .sidebar nav {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .nav-link {
                margin: 0;
                padding: 10px 12px;
                font-size: 13px;
            }

            .topbar {
                padding: 16px 20px;
            }

            .content {
                padding: 22px 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-value {
                font-size: 27px;
            }

            .form-panel {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: auto;
            }

            .footer {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="app-layout">

        <aside class="sidebar">
            <a href="{{ route('tasks.index') }}" class="brand">
                <span class="brand-icon">✓</span>
                <span>TaskFlow</span>
            </a>

            <p class="nav-label">Menú principal</p>

            <nav>
                <a
                    href="{{ route('tasks.index') }}"
                    class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}"
                >
                    ▦ &nbsp; Panel principal
                </a>

                <a href="{{ route('tasks.create') }}" class="nav-link">
                    ＋ &nbsp; Nueva tarea
                </a>
            </nav>
        </aside>

        <div class="main-area">
            <header class="topbar">
                <div>
                    <p class="topbar-title">Gestión personal</p>
                    <p class="topbar-subtitle">
                        Organiza tus pendientes y alcanza tus objetivos.
                    </p>
                </div>

                <div class="user-badge" title="Usuario local">TF</div>
            </header>

            <main class="content">
                @if (session('success'))
                    <div class="alert alert-success">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Revisa la información ingresada:</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="footer">
                TaskFlow · Gestor personal de tareas
            </footer>
        </div>

    </div>
</body>
</html>