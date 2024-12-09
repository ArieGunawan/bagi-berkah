<section class="space-y-6">

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-blog')"
    >{{ __('Delete Blog') }}</x-danger-button>

    <x-modal name="confirm-delete-blog" focusable>
        <form method="post" action="{{ route('blogs.destroy', $blog) }}" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your blog?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your blog is deleted, all of its resources and data will be permanently deleted.') }}
            </p>

            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Blog') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
