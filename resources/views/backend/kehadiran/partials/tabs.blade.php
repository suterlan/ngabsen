<div class="overflow-hidden border border-gray-100 dark:border-slate-700 bg-white dark:bg-indigo-900 dark:text-slate-400 p-1 mb-2">
  <ul class="flex items-center text-sm font-medium">
    <li class="flex-1">
      <a
        href="{{route('admin.presences.show', $attendance->id)}}"
        class="text-gra relative flex items-center justify-center gap-2 @if (request()->routeIs('admin.presences.show*')) bg-white/80 dark:bg-indigo-100 shadow @endif px-3 py-2 hover:bg-white/80 hover:text-gray-700 hover:shadow rounded"
      >
        Hadir</a
      >
    </li>
    <li class="flex-1">
      <a
        href="{{ route('admin.presences.izin', $attendance->id) }}"
        class="flex items-center justify-center gap-2 px-3 py-2 @if (request()->routeIs('admin.presences.izin*')) bg-white/80 dark:bg-indigo-100 shadow @endif hover:bg-white/80 hover:text-gray-700 hover:shadow rounded"
      >
        Izin</a
      >
    </li>
    <li class="flex-1">
      <a
        href="{{route('admin.presences.notpresent', $attendance->id)}}"
        class="flex items-center justify-center gap-2 px-3 py-2 @if (request()->routeIs('admin.presences.notpresent*')) bg-white/80 dark:bg-indigo-100 shadow @endif hover:bg-white/80 hover:text-gray-700 hover:shadow rounded"
      >
        Tidak Hadir</a
      >
    </li>
  </ul>
</div>