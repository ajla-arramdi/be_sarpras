<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen bg-white flex items-center justify-center px-4">
  <div class="bg-white shadow-2xl rounded-2xl max-w-md w-full overflow-hidden border border-gray-100">
    
    <!-- Header -->
    <div class="bg-red-600 text-white text-center py-8 px-6">
      <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-user-shield text-3xl"></i>
      </div>
      <h2 class="text-2xl font-bold">Welcome Admin</h2>
      <p class="text-sm mt-1 opacity-90">Sign in to your account</p>
    </div>

    <!-- Form -->
    <div class="px-6 py-8">
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        
        <!-- Email -->
        <div class="space-y-1">
          <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-red-500">
              <i class="fas fa-envelope"></i>
            </span>
            <input type="email" name="email" id="email" required placeholder="you@example.com"
              class="pl-10 w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
          </div>
        </div>

        <!-- Password -->
        <div class="space-y-1">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-red-500">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" name="password" id="password" required placeholder="••••••••"
              class="pl-10 w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
          </div>
        </div>

        <!-- Submit -->
        <button type="submit"
          class="w-full bg-red-600 hover:bg-red-700 transition-all duration-200 text-white font-semibold py-3 rounded-lg shadow-md hover:shadow-lg inline-flex justify-center items-center">
          <i class="fas fa-sign-in-alt mr-2"></i> Sign In
        </button>
      </form>
    </div>
  </div>
</body>
</html>
