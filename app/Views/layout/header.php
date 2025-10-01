<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Akademik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      margin: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
    }
    .sidebar {
      width: 250px;
      background: #0d6efd;
      color: #fff;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar .brand {
      font-size: 1.4rem;
      font-weight: bold;
      padding: 20px;
      text-align: center;
      background: #0b5ed7;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .sidebar .user-info {
      padding: 15px 20px;
      background: #0a58ca;
      font-size: 0.9rem;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .sidebar a {
      color: #e2e6ea;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      transition: all 0.2s;
    }
    .sidebar a:hover {
      background: #084298;
      color: #fff;
      padding-left: 28px;
    }
    /* ✅ Menu aktif */
    .sidebar a.active {
      background: #080b4eff; /* hijau bootstrap */
      color: #fff !important;
      font-weight: bold;
      border-radius: 6px;
      padding-left: 28px;
    }
    .sidebar .logout {
      border-top: 1px solid #beb4b4ff;
      padding: 15px 20px;
    }
    .content {
      flex-grow: 1;
      padding: 30px;
    }
    .hover-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>