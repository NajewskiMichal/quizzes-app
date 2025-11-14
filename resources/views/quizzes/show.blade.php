<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ $quiz['title'] }} – GeoAcademy</title>
</head>
<body>
    <h1>{{ $quiz['title'] }}</h1>

    <p>{{ $quiz['description'] }}</p>
    <p>
        Poziom: {{ $quiz['level'] }} |
        Region: {{ $quiz['region'] }}
    </p>

    <h2>Pytania</h2>

    @if (empty($quiz['questions']))
        <p>Brak pytań w tym quizie.</p>
    @else
        <form>
            @foreach ($quiz['questions'] as $question)
                <fieldset style="margin-bottom: 1.5rem;">
                    <legend>Pytanie {{ $loop->iteration }}: {{ $question['text'] }}</legend>

                    @foreach ($question['options'] as $option)
                        <div>
                            <label>
                                <input type="radio"
                                       name="question_{{ $question['id'] }}"
                                       value="{{ $option }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            @endforeach

            {{-- Na razie sam formularz, bez logiki sprawdzania --}}
            <button type="button" disabled>
                Sprawdź odpowiedzi (do zrobienia w kolejnej fazie)
            </button>
        </form>
    @endif

    <p style="margin-top: 2rem;">
        <a href="{{ route('quizzes.index') }}">← Wróć do listy quizów</a>
    </p>
</body>
</html>
