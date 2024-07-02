<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Notes Application</li>
                    <li class="treeview">
                        <li class="@if (Request::routeIs('notes.*')) active @endif">
                            <a href="{{ route('notes.index') }}">
                                <i class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span></i>
                                <span>Notes</span>
                            </a>
                        </li>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
