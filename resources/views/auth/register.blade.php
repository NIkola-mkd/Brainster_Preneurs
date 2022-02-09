<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-label for="name" :value="__('Name')" />

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <label for="surname" :value="__('Surname')" />

        <input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" :value="__('Email')" />

            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" :value="__('Password')" />

            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="flex justify-center">
            <div class="mb-3 xl:w-96">
                <label for="biography" class="form-label inline-block mb-2 text-gray-700">Biography</label>
                <textarea class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      " id="biography" rows="3" placeholder="Your message" name="biography"></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button class="ml-4">
                Register
            </button>
        </div>
    </form>
</body>

</html>