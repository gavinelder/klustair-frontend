
        @foreach ($vulnerabilities as $vulnerabily)
        <tr>
            <td>
                <b><a href="vulnerability/{{$vulnerabily['uid']}}">
                {{$vulnerabily['title']}}
                @if ($vulnerabily['title'] == "")
                {{ Str::limit($vulnerabily['descr'],200) }}
                @endif
                </a></b>
            </td>
            <td><nobr>{{$vulnerabily['vulnerability_id']}}<nobr></td>
            <td>{{$vulnerabily['pkg_name']}}</td>
            <td>
                @isset ($vulnerabily['cvss']['V3Score'])
                <div class="progress progress-xs">
                    <div class="progress-bar bg-purple" style="width: {{ $vulnerabily['cvss']['V3Vector_base_score']*10}}%"></div>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-fuchsia" style="width: {{ $vulnerabily['cvss']['V3Vector_modified_esc']*10}}%"></div>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-info" style="width: {{ $vulnerabily['cvss']['V3Vector_modified_isc']*10}}%"></div>
                </div>
                @endisset
                @if (@isset ($vulnerabily['cvss']['V2Score']) && !@isset ($vulnerabily['cvss']['V3Score']))
                <div class="progress progress-xs">
                    <div class="progress-bar bg-purple" style="width: {{ $vulnerabily['cvss']['V2Vector_base_score']*10}}%"></div>
                </div>
                @endif
            </td>
            <td><span class="badge {{$vulnseverity[$vulnerabily['severity']]}}">{{$vulnerabily['cvss_base_score']}}</span></td>
            <td>
                @if ($vulnerabily['fixed_version'] != "")
                <span class="badge badge-pill badge-success">yes</span>
                @endif
            </td>
            <td>
                <input type="checkbox" id="{{ $vulnerabily['vulnerability_id'] }}" class="whitelistItem" name="whitelist" value="{{ $vulnerabily['uid'] }}" @if ($vulnerabily['images_vuln_whitelist_uid'] != "") checked @endif>
            </td>
        </tr>
        <p>
        @endforeach