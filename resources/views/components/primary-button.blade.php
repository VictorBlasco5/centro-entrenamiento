<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
        inline-flex items-center px-4 py-2
        bg-[#222222]
        border border-[#d0d0d05d]
        font-semibold text-xs
        text-white tracking-widest
        hover:bg-black
        focus:outline-none focus:ring-2 focus:ring-white
    '
]) }}>
    {{ $slot }}
</button>