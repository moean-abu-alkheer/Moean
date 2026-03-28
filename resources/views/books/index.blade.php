<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>قائمة الكتب</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f3, #dfe9f3);
            font-family: 'Cairo', sans-serif;
        }

        .card {
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #333;
        }

        .badge {
            font-size: 0.8rem;
            padding: 6px 10px;
            border-radius: 10px;
        }

        .header-title {
            font-weight: 700;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn {
            border-radius: 10px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4facfe, #00c6ff);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="top-bar flex-wrap gap-3">

            <h2 class="header-title">📚 قائمة الكتب</h2>

            <div class="d-flex align-items-center gap-3">

                <!-- اسم المستخدم -->
                <div class="px-3 py-2 bg-white shadow-sm rounded-pill">
                    👤 {{ auth()->user()->name }}
                </div>

                <!-- زر إضافة -->
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    ➕ إضافة كتاب
                </a>

                <!-- زر تسجيل الخروج -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-dark px-3">
                        🚪 تسجيل الخروج
                    </button>
                </form>

            </div>
        </div>
        @if (session('success'))
            <div class="alert text-white text-start shadow-sm"
                style="background: linear-gradient(45deg, #00c6ff, #0072ff); border-radius:10px;">

                {{ session('success') }}

            </div>
        @endif
        <div class="row">
            @forelse($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-0">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title fw-bold">
                                    {{ $book->title }}
                                </h5>
                                <span class="badge {{ $book->status ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                    {{ $book->status ? 'متاح' : 'غير متاح' }}
                                </span>
                            </div>

                            <p class="text-muted mb-1">
                                ✍️ {{ $book->author }}
                            </p>

                            <p class="mb-3">
                                📅 {{ $book->published_year ?? 'غير محدد' }}
                            </p>

                        </div>

                        <div
                            class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">

                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary"
                                style="width: 150px;">
                                ✏️ تعديل
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="post" >
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-sm btn-danger" style="width: 150px;"> 🗑️ حذف
                                </button>

                            </form>

                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="p-5 bg-white rounded shadow-sm">
                        <h5 class="text-muted">😢 لا توجد كتب حالياً</h5>
                        <a href="{{ route('books.create') }}" class="btn btn-primary mt-3">
                            أضف أول كتاب
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

    </div>

</body>

</html>
