<div
    id="comment-{{ $comment->id }}"
    class="@if ($comment->is_status_update) is-status-update {{ 'status-'.Str::kebab($comment->status->name)}}@endif comment-container relative bg-white rounded-xl flex transition duration-500 ease-in mt-4"
>
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 ht-14 rounded-xl">
            </a>
            @if ($comment->user->isAdmin())
                <div class="text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
            @endif
        </div>
        <div class="md:mx-4 w-full">
            <div class="text-gray-600">
                @admin
                    @if ($comment->spam_reports > 0)
                    <div class="text-red mb-2">Spam Reports: {{$comment->spam_reports}}</div>
                    @endif
                @endadmin
                @if($comment->is_status_update)
                <h4 class="text-xl font-semibold mb-3">
                    Status Changed to "{{$comment->status->name}}"
                </h4>
                @endif
                <div>
                    {!! nl2br(e($comment->body)) !!}
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="@if($comment->is_status_update) text-blue @endif font-bold text-gray-900">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    @if ($comment->user->id == $ideaUserId)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <div>&bull;</div>
                    @endif
                    <div>{{ $comment->created_at->diffForHumans()}}</div>
                </div>
                @auth
                <div
                    x-data="{ isOpen : false }"
                    class="flex items-center space-x-2">
                    <div class="relative">
                        <button
                            @click="isOpen = !isOpen"
                            class="relative  bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border">
                            <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                        </button>
                        <ul
                            x-show="isOpen" x-transition.duration.500ms
                            x-cloak
                            @click.away="isOpen = false"
                            class="absolute z-20 w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3
                            ml-8 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                            @can('update',$comment)
                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setEditComment', {{ $comment->id }})
                                        "
                                        class="hover:bg-gray-100 transition duration-150 block ease-in px-5 py-3"
                                    >
                                        Edit Comment
                                    </a>
                                </li>
                            @endcan
                            @can('delete',$comment)
                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setDeleteComment', {{ $comment->id }})
                                        "
                                        class="hover:bg-gray-100 transition duration-150 block ease-in px-5 py-3"
                                    >
                                        Delete Comment
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a
                                    href="#"
                                    @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                    "
                                    class="hover:bg-gray-100 transition duration-150 block ease-in px-5 py-3"
                                >
                                    Mark as Spam
                                </a>
                            </li>
                            @admin
                                @if($comment->spam_reports > 0)
                                    <li>
                                        <a href="#"
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                        "
                                        class="hover:bg-gray-100 transition duration-150 block ease-in px-5 py-3"
                                    >
                                        Not Spam
                                        </a>
                                    </li>
                                @endif
                            @endadmin
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div> {{-- end comment-container --}}