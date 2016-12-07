package com.example.mihkel.libraryapp.Various;

import android.text.TextUtils;
import android.util.Log;

import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Genre;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.Item.Keyword;
import com.example.mihkel.libraryapp.Item.Language;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by mihkel on 5.12.2016.
 */

public class URLCreator {


    public static final int URL_TYPE_AUTHORS = 0;
    public static final int URL_TYPE_KEYWORDS = 1;
    public static final int URL_TYPE_GENRES = 2;

    public static String getURL(Integer urlType) {
        switch (urlType) {
            case URL_TYPE_KEYWORDS:
                return "http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Märksõnad";
            case URL_TYPE_AUTHORS:
                return "http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Autorid";
            case URL_TYPE_GENRES:
                return "http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Zanrid";
        }
        return "";
    }

    public String createResultURL(Selection selection) {
        String resultUrl = createURLStart() + "Otsing?";
//        if (selection.getLanguages() != null & selection.getLanguages().size() > 0) {
//            resultUrl = resultUrl + implodeItem(",", selection.getLanguages());
//        }

        if (selection.getKeywords() != null & selection.getKeywords().size() > 0) {
            resultUrl = resultUrl.concat("&märksõna=" + implodeItem(",", selection.getKeywords()));
        }

        if (selection.getGenres() != null & selection.getGenres().size() > 0) {
//            resultUrl = resultUrl + implodeItem(",", selection.getGenres());
            resultUrl = resultUrl.concat("&zanr=" + implodeItem(",", selection.getGenres()));
        }

        if (selection.getAuthors() != null & selection.getAuthors().size() > 0) {
            resultUrl = resultUrl.concat("&autor=" + implodeItemAuthor(",", selection.getAuthors()));
//            resultUrl = resultUrl + implodeItem(",", selection.getAuthors());
        }

        int yearFrom = 0;
        int yearTo= 9999;
        if (selection.getYearFrom() != null)
            yearFrom = selection.getYearFrom();
        if (selection.getYearTo() != null)
            yearTo = selection.getYearTo();
        resultUrl = resultUrl.concat("&aasta="+yearFrom+","+yearTo);

//        return createURLStart() + "Otsing";
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        Log.d("uuuuuuuuuuuuurl", resultUrl);
        return resultUrl;
    }

    public String createKeywordsAutoCompleteURL(String characters) {
        return createURLStart() + "Autorid?" + characters;
    }

    public String createGenreAutoCompleteURL(String characters) {
        return createURLStart() + "Zanrid?" + characters;
    }

    public String createAuthorAutoCompleteURL(String characters) {
        return createURLStart() + "Märksõnad?" + characters;
    }

    public String createURLStart() {
        return "http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/";
    }

    //--------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------
    public static String implodeItem(String separator, HashMap<Integer, Item> objectHashMap) {
        List<String> list = new ArrayList<>();
        for (Map.Entry<Integer, Item> entry : objectHashMap.entrySet()) {
//            System.out.println(entry.getKey() + "/" + entry.getValue());
            list.add(entry.getValue().getName());
        }
        String joined = TextUtils.join(", ", list);
        return joined;
    }

    public static String implodeItemAuthor(String separator, HashMap<Integer, Item> objectHashMap) {
        List<String> list = new ArrayList<>();
        for (Map.Entry<Integer, Item> entry : objectHashMap.entrySet()) {
//            System.out.println(entry.getKey() + "/" + entry.getValue());
            String[] exploded=entry.getValue().getName().split(" ");
            list.add(exploded[1]);
        }
        String joined = TextUtils.join(", ", list);
        return joined;
    }

    public static String implodeLanguage(String separator, HashMap<Integer, Language> objectHashMap) {
        List<String> list = new ArrayList<>();
        for (Map.Entry<Integer, Language> entry : objectHashMap.entrySet()) {
//            System.out.println(entry.getKey() + "/" + entry.getValue());
            list.add(entry.getValue().getName());
        }
        String joined = TextUtils.join(", ", list);
        return joined;
    }

    public static String implodeGenre(String separator, HashMap<Integer, Genre> objectHashMap) {
        List<Integer> list = new ArrayList<>();
        for (Map.Entry<Integer, Genre> entry : objectHashMap.entrySet()) {
//            System.out.println(entry.getKey() + "/" + entry.getValue());
            list.add(entry.getValue().getId());
        }
        String joined = TextUtils.join(", ", list);
        return joined;
    }

    public static String implodeKeyword(String separator, HashMap<Integer, Keyword> objectHashMap) {
        List<Integer> list = new ArrayList<>();
        for (Map.Entry<Integer, Keyword> entry : objectHashMap.entrySet()) {
//            System.out.println(entry.getKey() + "/" + entry.getValue());
            list.add(entry.getValue().getId());
        }
        String joined = TextUtils.join(", ", list);
        return joined;
    }

    public static String implodeAuthor(String separator, HashMap<Integer, Author> objectHashMap) {
        List<Integer> list = new ArrayList<>();
        for (Map.Entry<Integer, Author> entry : objectHashMap.entrySet()) {
//            System.out.println(entry.getKey() + "/" + entry.getValue());
            list.add(entry.getValue().getId());
        }
        String joined = TextUtils.join(", ", list);
        return joined;
    }
//
//    public static String implodeName(String separator, HashMap<Integer, Item> objectHashMap) {
//        List<String> list = new ArrayList<>();
//        for (Map.Entry<Integer, Item> entry : objectHashMap.entrySet()) {
////            System.out.println(entry.getKey() + "/" + entry.getValue());
//            list.add(entry.getValue().getName());
//        }
//        String joined = TextUtils.join(", ", list);
//        return joined;
//    }


}
