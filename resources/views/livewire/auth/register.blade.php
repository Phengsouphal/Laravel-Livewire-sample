<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
      
      </div>
      <form class="mt-8 space-y-6" wire:submit.prevent="register">
        <input type="hidden" name="remember" value="true">
        <div class="">
            <div >
                <label for="name" class="sr-only">Name</label>
                <input wire:model='name' id="name" name="name" type="name" autocomplete="name" required class=" @error('name') border-red-500 @enderror relative block w-full appearance-none rounded-none rounded-md  border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Name">
                @error('name') <div class="text-red-400 text-xs mt1">{{ $message }}</div>@enderror
           
            </div>
          <div class="mt-4">
            <label for="email" class="sr-only">Email address</label>
            <input wire:model='email' id="email" name="email" type="email" autocomplete="email" required class=" @error('email') border-red-500 @enderror relative block w-full appearance-none rounded-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address">
            @error('email') <div class="text-red-400 text-xs mt1">{{ $message }}</div>@enderror

        </div>
          <div class="mt-4">
            <label for="password" class="sr-only">Password</label>
            <input wire:model='password' id="password" name="password" type="password" autocomplete="current-password" required class=" @error('password') border-red-500  @enderror relative block w-full appearance-none rounded-none rounded-md  border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password">
            @error('password') <div class="text-red-400 text-xs mt1">{{ $message }}</div>@enderror
       
        </div>
          <div class="mt-4">
            <label for="passwordConfirmation" class="sr-only">Password Confirmation</label>
            <input wire:model='passwordConfirmation' id="passwordConfirmation" name="passwordConfirmation" type="password" autocomplete="passwordConfirmation" required class=" @error('passwordConfirmation') border-red-500 @enderror relative block w-full appearance-none rounded-none rounded-md  border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password Confirmation">
            @error('passwordConfirmation') <div class="text-red-400 text-xs mt1">{{ $message }}</div>@enderror
        
        </div>
        </div>
  
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
          </div>
  
          <div class="text-sm">
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
          </div>
        </div>
  
        <div>
          <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <!-- Heroicon name: mini/lock-closed -->
              <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
              </svg>
            </span>
            Sign in
          </button>
        </div>
      </form>
    </div>
  </div>



{{-- <form wire:submit.prevent="register">
{{$email}}
{{$password}}
{{$passwordConfirmation}}
<div>
    <label for="name">Name</label>
    <input wire:model='name' type="text" id="name" name="name">
    @error('name') <span>{{ $message }}</span> @enderror
</div>
<div>
    <label for="email">Email</label>
    <input wire:model='email' type="text" id="email" name="email">
    @error('email') <span>{{ $message }}</span> @enderror

</div>

<div>
    <label for="password">Password</label>
    <input  wire:model.lazy='password' type="password" id="password" name="password">
    @error('password') <span>{{ $message }}</span> @enderror

</div>

<div>
    <label for="passwordConfirmation">Password Confirm</label>
    <input  wire:model.lazy='passwordConfirmation' type="password" id="passwordConfirmation" name="passwordConfirmation">
</div>
<button type="submit" >Register</button>
</form> --}}