<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-secondary mx-2']) }}>
    {{ $slot }}
</button>
