/*
Author: Daniel St. Germain
Last Edited: 9/13/14
Do not copy without permission
*/

geek.service("getJSON", function($q, $http) {
    return {
        getPage: function() {
            var defer = $q.defer();
            $http({
                url: "/api/get_page/?id=24",
                method: "GET",
                cache: true,
            }).success(function(data, status) {
                defer.resolve(data);
            }).error(function(data, status) {
                defer.resolve("Request failed");
            });

            return defer.promise;
        },
        getHome: function() {
            var ms = this,
                defer = $q.defer();
            ms.getPage().then(function(data) {
                var content = {};
                //video
                var video_object = unserialize(data.page.custom_fields.Video);
                content.video = video_object[0]["video-container"];
                //bikes header
                var bikes_object = unserialize(data.page.custom_fields["bikes-header"]);
                content.bikesHeader = bikes_object[0]["bikes-header"];

                //bar bikes lineup
                var bikes_lineup_object = unserialize(data.page.custom_fields["bikes-lineup"]),
	                i = 0;
                content.bikes = {};
                $.each( bikes_lineup_object, function( key, value ) {
					content.bikes[i] = {
                        img: value.image,
                        page: value.url,
                        sub: value["sub-title"],
                        tit: value.title
                    };
                    i++;
				});

				//posts
				var posts_object = unserialize(data.page.custom_fields.posts),
					j = 0;
                content.posts = {};
                $.each( posts_object, function( key, value ) {
					content.posts[j] = {
                        slug: value["post-slug"]
                    };
                    j++;
				});
               
				//rotator
				var rotator_object = unserialize(data.page.custom_fields.rotator),
					k = 0;
                content.rotator = {};
                $.each(rotator_object, function(index, value) {
                    content.rotator[k] = {
                        url: value.image
                    };
                    k++;
                });

                defer.resolve(content);
            });
            return defer.promise;
        },
        getCartel: function() {
            var deferred = $q.defer();
            $http({
                method: 'GET',
                url: '//api.bigcartel.com/geekhousebikes/products.json'
            }).success(function(data) {
                function sortByProperty(property) {
                    return function(a, b) {
                        var sortStatus = 0;
                        if (a[property] < b[property]) {
                            sortStatus = -1;
                        } else if (a[property] > b[property]) {
                            sortStatus = 1;
                        }

                        return sortStatus;
                    };
                }

                data.sort(sortByProperty('created_at'));
                deferred.resolve(data);

            }).error(function(data, status) {
                deferred.resolve(status);
            });

            return deferred.promise;
        },
        getPost: function(slug) {
            var deferred = $q.defer();
            $http({
                method: 'GET',
                url: '/api/get_post/?slug=' + slug
            }).success(function(data) {
                deferred.resolve(data);

            }).error(function(data, status) {
                deferred.resolve(status);
            });

            return deferred.promise;
        },
        getInstagram: function() {
            var deferred = $q.defer();
            var endPoint = "https://api.instagram.com/v1/users/31741476/media/recent?access_token=40066797.24a6152.498a62d28179413a89099a4654537c2f&callback=JSON_CALLBACK";

            $http.jsonp(endPoint).success(function(response) {
                if (response.meta.code !== '200') {
                    deferred.resolve([]);
                    return;
                }
                deferred.resolve(response.data);
            });

            return deferred.promise;
        }
    };
});

function unserialize(data) {
    //  discuss at: http://phpjs.org/functions/unserialize/
    // original by: Arpad Ray (mailto:arpad@php.net)
    // improved by: Pedro Tainha (http://www.pedrotainha.com)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Chris
    // improved by: James
    // improved by: Le Torbi
    // improved by: Eli Skeggs
    // bugfixed by: dptr1988
    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //  revised by: d3x
    //    input by: Brett Zamir (http://brett-zamir.me)
    //    input by: Martin (http://www.erlenwiese.de/)
    //    input by: kilops
    //    input by: Jaroslaw Czarniak
    //        note: We feel the main purpose of this function should be to ease the transport of data between php & js
    //        note: Aiming for PHP-compatibility, we have to translate objects to arrays
    //   example 1: unserialize('a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}');
    //   returns 1: ['Kevin', 'van', 'Zonneveld']
    //   example 2: unserialize('a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}');
    //   returns 2: {firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'}

    var that = this,
        utf8Overhead = function(chr) {
            // http://phpjs.org/functions/unserialize:571#comment_95906
            var code = chr.charCodeAt(0);
            if (code < 0x0080) {
                return 0;
            }
            if (code < 0x0800) {
                return 1;
            }
            return 2;
        };
    error = function(type, msg, filename, line) {
        throw new that.window[type](msg, filename, line);
    };
    read_until = function(data, offset, stopchr) {
        var i = 2,
            buf = [],
            chr = data.slice(offset, offset + 1);

        while (chr != stopchr) {
            if ((i + offset) > data.length) {
                error('Error', 'Invalid');
            }
            buf.push(chr);
            chr = data.slice(offset + (i - 1), offset + i);
            i += 1;
        }
        return [buf.length, buf.join('')];
    };
    read_chrs = function(data, offset, length) {
        var i, chr, buf;

        buf = [];
        for (i = 0; i < length; i++) {
            chr = data.slice(offset + (i - 1), offset + i);
            buf.push(chr);
            length -= utf8Overhead(chr);
        }
        return [buf.length, buf.join('')];
    };
    _unserialize = function(data, offset) {
        var dtype, dataoffset, keyandchrs, keys, contig,
            length, array, readdata, readData, ccount,
            stringlength, i, key, kprops, kchrs, vprops,
            vchrs, value, chrs = 0,
            typeconvert = function(x) {
                return x;
            };

        if (!offset) {
            offset = 0;
        }
        dtype = (data.slice(offset, offset + 1))
            .toLowerCase();

        dataoffset = offset + 2;

        switch (dtype) {
            case 'i':
                typeconvert = function(x) {
                    return parseInt(x, 10);
                };
                readData = read_until(data, dataoffset, ';');
                chrs = readData[0];
                readdata = readData[1];
                dataoffset += chrs + 1;
                break;
            case 'b':
                typeconvert = function(x) {
                    return parseInt(x, 10) !== 0;
                };
                readData = read_until(data, dataoffset, ';');
                chrs = readData[0];
                readdata = readData[1];
                dataoffset += chrs + 1;
                break;
            case 'd':
                typeconvert = function(x) {
                    return parseFloat(x);
                };
                readData = read_until(data, dataoffset, ';');
                chrs = readData[0];
                readdata = readData[1];
                dataoffset += chrs + 1;
                break;
            case 'n':
                readdata = null;
                break;
            case 's':
                ccount = read_until(data, dataoffset, ':');
                chrs = ccount[0];
                stringlength = ccount[1];
                dataoffset += chrs + 2;

                readData = read_chrs(data, dataoffset + 1, parseInt(stringlength, 10));
                chrs = readData[0];
                readdata = readData[1];
                dataoffset += chrs + 2;
                if (chrs != parseInt(stringlength, 10) && chrs != readdata.length) {
                    error('SyntaxError', 'String length mismatch');
                }
                break;
            case 'a':
                readdata = {};

                keyandchrs = read_until(data, dataoffset, ':');
                chrs = keyandchrs[0];
                keys = keyandchrs[1];
                dataoffset += chrs + 2;

                length = parseInt(keys, 10);
                contig = true;

                for (i = 0; i < length; i++) {
                    kprops = _unserialize(data, dataoffset);
                    kchrs = kprops[1];
                    key = kprops[2];
                    dataoffset += kchrs;

                    vprops = _unserialize(data, dataoffset);
                    vchrs = vprops[1];
                    value = vprops[2];
                    dataoffset += vchrs;

                    if (key !== i)
                        contig = false;

                    readdata[key] = value;
                }

                if (contig) {
                    array = new Array(length);
                    for (i = 0; i < length; i++)
                        array[i] = readdata[i];
                    readdata = array;
                }

                dataoffset += 1;
                break;
            default:
                error('SyntaxError', 'Unknown / Unhandled data type(s): ' + dtype);
                break;
        }
        return [dtype, dataoffset - offset, typeconvert(readdata)];
    };

    return _unserialize((data + ''), 0)[2];
}
