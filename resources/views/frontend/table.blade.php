<style>
    /*

RESPONSTABLE 2.0 by jordyvanraaij
  Designed mobile first!

If you like this solution, you might also want to check out the 1.0 version:
  https://gist.github.com/jordyvanraaij/9069194

*/
    .responstable {
        margin: 1em 0;
        width: 100%;
        overflow: hidden;
        background: #FFF;
        color: #024457;
        border-radius: 10px;
        border: 1px solid #167F92;
        direction: rtl;
    }
    .responstable tr {
        border: 1px solid #D9E4E6;
    }
    .responstable tr span{
        text-align: center;
    }
    .responstable tr:nth-child(odd) {
        background-color: #EAF3F3;
    }
    .responstable th {
        display: none;
        border: 1px solid #FFF;
        background-color: #167F92;
        color: #FFF;
        padding: 1em;
        text-align: center;

    }
    .responstable th:first-child {
        display: table-cell;
        text-align: center;
    }
    .responstable th:nth-child(2) {
        display: table-cell;
    }
    .responstable th:nth-child(2) span {
        display: none;
    }
    .responstable th:nth-child(2):after {
        content: attr(data-th);
    }
    @media (min-width: 480px) {
        .responstable th:nth-child(2) span {
            display: block;
        }
        .responstable th:nth-child(2):after {
            display: none;
        }
    }
    .responstable td {
        display: block;
        word-wrap: break-word;
        max-width: 7em;
    }
    .responstable td:first-child {
        display: table-cell;
        text-align: center;
        border-right: 1px solid #D9E4E6;
    }
    @media (min-width: 480px) {
        .responstable td {
            border: 1px solid #D9E4E6;
        }
    }
    .responstable th, .responstable td {
        text-align: left;
        margin: .5em 1em;
    }
    @media (min-width: 480px) {
        .responstable th, .responstable td {
            display: table-cell;
            padding: 1em;
            text-align: center;

        }
    }


</style>


<section class="well2 cntr">
    <div class="container">
        <div class="row">
            <div class="grid_10 preffix_1">
                <h2>
                    {{$cat->title}}
                </h2>
                @if(isset($contents[0]))
                <table class="responstable">
                    <tr>
                        <th>
                            نام ضایعات
                        </th>
                        <th data-th="Driver details">
                            <span>قیمت</span>
                        </th>
                        <th>
                            تاریخ به روز رسانی
                        </th>
                    </tr>
                    @foreach($contents as $content)
                        <tr>
                            <td>{{$content->title}}</td>
                            <td>{{$content->price}}</td>
                            <td>01/01/1978</td>
                        </tr>
                    @endforeach
                </table>
                 @else
                    <p>
                        {{$cat->description}}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>
