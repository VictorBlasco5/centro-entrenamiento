<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
        inline-flex items-center px-2 py-2
        bg-[#222222]
        border border-[#d0d0d05d]
        text-xs
        text-white tracking-widest
        hover:bg-black
        focus:outline-none
    '
]) }}>
    {{ $slot }}
</button>