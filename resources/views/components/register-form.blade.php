<div class="flex justify-center items-center min-h-screen ">
    <div class="w-full max-w-4xl p-8 space-y-6 rounded-xl bg-white shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-700 mb-6">Register</h1>
        <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div class="form-control w-full">
                <label for="fullname" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" name="fullname" id="fullname" placeholder="Isi dengan Nama Lengkap" class="input input-bordered w-full @error('fullname') input-error @enderror" value="{{ old('fullname') }}">
                @error('fullname')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control w-full">
                <label for="nik" class="block text-sm font-medium text-gray-600">Nik</label>
                <input type="text" name="nik" id="nik" placeholder="Isi dengan Nik" class="input input-bordered w-full @error('nik') input-error @enderror" value="{{ old('nik') }}">
                @error('nik')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control w-full">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email" placeholder="Isi dengan Email" class="input input-bordered w-full @error('email') input-error @enderror" value="{{ old('email') }}">
                @error('email')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control w-full">
                <label for="address" class="block text-sm font-medium text-gray-600">Alamat</label>
                <input type="text" name="address" id="address" placeholder="Isi dengan Alamat" class="input input-bordered w-full @error('address') input-error @enderror" value="{{ old('address') }}">
                @error('address')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control w-full">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" name="password" id="password" placeholder="Isi dengan Password" class="input input-bordered w-full @error('password') input-error @enderror">
                @error('password')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control w-full">
                <label for="confirm-password" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirm-password" placeholder="Isi Passwordnya Lagi" class="input input-bordered w-full">
                <span class="text-error text-sm" id="password-match-error"></span>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="btn btn-primary w-full">Register</button>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-center text-gray-600">Already have an account? <a href="/login" class="text-indigo-600 underline">Sign in</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirm-password').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const errorMessage = document.getElementById('password-match-error');
        if (password !== confirmPassword) {
            errorMessage.textContent = 'Password and Confirm Password do not match.';
        } else {
            errorMessage.textContent = '';
        }
    });
</script>
