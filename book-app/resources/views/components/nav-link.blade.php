@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-600 dark:border-indigo-400 text-sm font-medium leading-5 text-black dark:text-white focus:outline-none focus:border-indigo-800 transition duration-150 ease-in-out'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-800 dark:text-gray-200 hover:text-black dark:hover:text-white hover:border-gray-500 dark:hover:border-gray-400 focus:outline-none focus:text-black dark:focus:text-white focus:border-gray-600 dark:focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
