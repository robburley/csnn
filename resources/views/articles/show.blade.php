@extends('layout.web')

@section('title', '| Counter Strike Global News')

@section('content')
    <div class="flex flex-wrap -mx-4">
        @include('partials.breadcrumbs', ['breadcrumbs' => $article->category->getParents()])

        <h1 class="w-full pl-4 -ml-4 text-5xl mb-4 border-l-4 border-orange font-bold text-black">{{ $article->title }}</h1>

        <h3 class="w-full mb-4 border-l-4 border-transparent font-normal text-2xl text-grey-darker">{{ $article->headline }}</h3>

        <div class="w-full pl-1 flex border-t border-b border-grey-light py-4 mb-4">
            <div class="flex items-center text-lg">
                <h4 class="mr-2">Share</h4>

                <a href="" class="no-underline text-white">
                    <i class="fab fa-facebook-f px-5 py-4 mr-2 bg-blue-darker rounded-full"></i>
                </a>

                <a href="" class="no-underline text-white">
                    <i class="fab fa-twitter p-4 mr-2 bg-blue-light rounded-full"></i>
                </a>

                <a href="" class="no-underline text-white">
                    <i class="fab fa-linkedin px-4 py-4 mr-2 bg-blue-dark rounded-full"></i>
                </a>

            </div>

            <div class="ml-auto pl-4 border-l border-grey-light">
                <div class="">
                    By <span>{{ $article->creator->name }}</span>
                </div>

                <div class="text-xs">
                    <span class="font-bold">Updated</span> {{ $article->updated_at->format('d F Y H:i') }}
                </div>
            </div>
        </div>

        <div class="w-full pl-1 mb-4 flex ">
            <div class="text-lg flex-1 pr-2">
                {!! $article->content !!}
            </div>

            <div class="w-1/4">
                <h4 class="pb-4">Recommended</h4>

                @foreach($article->relatedArticles() as $relatedArticle)
                    <div class="w-full mb-4 flex">
                        <a class="w-1/2 mr-4" href="{{ route('articles.show', $relatedArticle) }}">
                            <img src="https://via.placeholder.com/400x200"
                                 alt="{{ $relatedArticle->title }}"
                                 class="w-full border-b-4 border-orange hover:border-black"
                            >
                        </a>

                        <div class="flex w-1/2">
                            <a class="font-normal text-black no-underline hover:text-orange text-sm"
                               href="{{ route('articles.show', $relatedArticle) }}"
                            >
                                {{ $relatedArticle->title }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
@endsection