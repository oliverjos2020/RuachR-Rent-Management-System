@foreach ($cat as $categories)
                                            <li>
                                            <a href="?category={{$categories->id}}" style="margin-bottom: 15px;">{{$categories->name}}</a>
                                            </li>
                                            <hr style="margin-top: 5px; margin-bottom: 10px;">
                                            @endforeach