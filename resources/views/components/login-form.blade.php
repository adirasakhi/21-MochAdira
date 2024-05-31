    <div class="flex justify-center items-center min-h-screen ">
        <div class="w-full max-w-md p-8 space-y-8 rounded-lg bg-white shadow-lg">
            <h1 class="text-3xl font-semibold text-center text-gray-700">Sign In</h1>
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div class="form-control w-full">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" placeholder="Isi dengan Email" class="input input-bordered w-full @error('email') input-error @enderror" value="{{ old('email') }}">
                    @error('email')
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
                <button type="submit" class="btn btn-primary w-full">Sign In</button>
                <p class="text-sm text-center text-gray-600">Don't have an account? <a href="/register" class="text-indigo-600 underline">Sign up</a></p>
            </form>
        </div>
    </div>
