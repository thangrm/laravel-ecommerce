<x-app-layout>
    <a href="{{route('admin.login.logout')}}">Đăng xuất</a>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        Hello user: {{ Auth::user()->name  }}
    </div>
</x-app-layout>
