<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة كتاب</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f3, #dfe9f3);
            font-family: 'Cairo', sans-serif;
        }

        .card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            border-radius: 15px 15px 0 0;
        }

        .form-control, .form-select {
            border-radius: 10px;
            text-align: right;
            direction: rtl;
        }

        .form-control::placeholder {
            text-align: right;
            direction: rtl;
        }

        .btn-success {
            background: linear-gradient(45deg, #4facfe, #00c6ff);
            border: none;
        }

        .btn-secondary {
            border-radius: 10px;
        }

        .header-title {
            font-weight: 700;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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

    <!-- Header -->
    <div class="top-bar">
        <h3 class="header-title">➕ إضافة كتاب جديد</h3>

        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            رجوع
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger text-end">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">اسم الكتاب</label>
                            <input type="text" name="title" class="form-control"
                                   placeholder="مثال: فن اللامبالاة" required>
                        </div>

                        <!-- Author -->
                        <div class="mb-3">
                            <label class="form-label">اسم المؤلف</label>
                            <input type="text" name="author" class="form-control"
                                   placeholder="مثال: مارك مانسون" required>
                        </div>

                        <!-- Year -->
                        <div class="mb-3">
                            <label class="form-label">سنة النشر</label>
                            <input type="number" name="published_year" class="form-control"
                                   placeholder="مثال: 2016">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label">الحالة</label>
                            <select name="status" class="form-select">
                                <option value="1">متاح</option>
                                <option value="0">غير متاح</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">

                            <button type="submit" class="btn btn-success px-4">
                                💾 حفظ
                            </button>

                            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary px-4">
                                إلغاء
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
