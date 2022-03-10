<div>
    @if ($comments->isNotEmpty())
        <div class="comments-container relative space-y-6 md:ml-22 my-8 pt-4 mt-1">

            @foreach ($comments as $comment)
                <livewire:idea-comment
                    :key="$comment->id"
                    :comment="$comment"
                    :ideaUserId="$idea->user->id"
                />
            @endforeach


        </div> {{-- end comments-container --}}
    @else
        <div class="mx-auto w-70 mt-12">
            <img src="{{ asset('img/no-ideas.svg')}}" alt="No Ideas" class="mx-auto" style="mix-blend-mode:luminosity">
            <div class="text-gray-400 text-center font-bold mt-7">
                No comments yet...
            </div>
        </div>
    @endif
</div>
