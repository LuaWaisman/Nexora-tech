@props(['name', 'size' => 32])
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
@if($name === 'home')
  <path d="M3 11.5 12 3l9 8.5V21h-6v-6H9v6H3z" fill="currentColor" stroke="none"/>
@elseif($name === 'menu')
  <path d="M3 6h18M3 12h18M3 18h18" stroke-width="2.4"/>
@elseif($name === 'plus')
  <circle cx="12" cy="12" r="11" fill="#e0b3ff" stroke="none"/><circle cx="12" cy="12" r="8.5" fill="none" stroke="#fff" stroke-width="1.6"/><path d="M12 7.5v9M7.5 12h9" stroke="#fff" stroke-width="2.4"/>
@elseif($name === 'user')
  <circle cx="12" cy="8" r="4.2" fill="currentColor" stroke="none"/><path d="M3 22c0-5 3.6-8 9-8s9 3 9 8z" fill="currentColor" stroke="none"/>
@elseif($name === 'logout')
  <path d="M10 3H5a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h5"/><path d="M10 12h11M17 8l4 4-4 4"/>
@elseif($name === 'search')
  <circle cx="10.5" cy="10.5" r="6.5"/><path d="m15.5 15.5 6 6" stroke-width="2.4"/>
@elseif($name === 'computer')
  <rect x="2" y="3" width="15" height="11" rx="1" stroke-width="2.4"/><path d="M9.5 14v3M5 20h9M7 17h5" stroke-width="2.4"/><rect x="18.5" y="4" width="3.5" height="14" rx="1" fill="currentColor"/>
@elseif($name === 'wifi')
  <path d="M2 9a15 15 0 0 1 20 0M5 12.5a10.5 10.5 0 0 1 14 0M8.3 16a6 6 0 0 1 7.4 0" stroke-width="2.4"/><circle cx="12" cy="19.5" r="1.6" fill="currentColor"/>
@elseif($name === 'alert')
  <circle cx="12" cy="12" r="10" stroke-width="1.8"/><path d="M12 6.5v7" stroke="#2a9d10" stroke-width="3"/><circle cx="12" cy="17.3" r="1.5" fill="#2a9d10" stroke="none"/>
@elseif($name === 'check')
  <circle cx="12" cy="12" r="11" fill="#2fce00" stroke="none"/><path d="m6.5 12.5 4 4 7-8" stroke="#fff" stroke-width="2.6"/>
@elseif($name === 'clock')
  <circle cx="12" cy="12" r="10" stroke="#ee8e10" stroke-width="2.2"/><path d="M12 6v6.5l4 2.5" stroke="#ee8e10" stroke-width="2.2"/>
@elseif($name === 'hourglass')
  <path d="M5 2.5h14M5 21.5h14M6.5 2.5c0 5 3 6 5.5 9.5-2.5 3.500-5.500 4.500-5.500 9.500M17.500 2.500c0 5-3 6-5.500 9.500 2.500 3.500 5.500 4.500 5.500 9.500" stroke="#d01457" stroke-width="2.2"/>
@elseif($name === 'back')
  <path d="M2 12 11 4v5h11v6H11v5z" fill="currentColor" stroke="none"/>
@elseif($name === 'clip')
  <path d="m20 11-8.500 8.500a5 5 0 0 1-7-7L13 4a3.300 3.300 0 0 1 4.700 4.700L9.200 17.200a1.700 1.700 0 0 1-2.400-2.400L14.500 7"/>
@endif
</svg>
