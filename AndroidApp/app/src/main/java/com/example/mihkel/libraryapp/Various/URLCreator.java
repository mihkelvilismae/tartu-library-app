package com.example.mihkel.libraryapp.Various;

import android.text.TextUtils;

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
import java.util.StringJoiner;
import java.util.regex.Pattern;

/**
 * Created by mihkel on 5.12.2016.
 */

public class URLCreator {

    public String createResultURL(Selection selection) {
        String resultUrl = "";
        if (selection.getLanguages().size() > 0) {
            resultUrl = resultUrl + implodeLanguage(",", selection.getLanguages());
        }

        if (selection.getKeywords().size() > 0) {
            resultUrl = "&" + resultUrl + implodeKeyword(",", selection.getKeywords());
        }

        if (selection.getGenres().size() > 0) {
            resultUrl = "&" + resultUrl + implodeGenre(",", selection.getGenres());
        }

        if (selection.getAuthors().size() > 0) {
            resultUrl = "&" + resultUrl + implodeAuthor(",", selection.getAuthors());
        }

        return resultUrl;
    }

    public String createKeywordsAutoCompleteURL(String selection) {
        return createURLStart() + "Autorid/" + selection;
    }

    public String createGenreAutoCompleteURL(String selection) {
        return createURLStart() + "Zanrid/" + selection;
    }

    public String createAuthorAutoCompleteURL(String selection) {
        return createURLStart() + "Märksõnad/" + selection;
    }

    public String createURLStart() {
        return "admin-mihkelvilismae.rhcloud.com/AdminInterface/json/";
    }

    //--------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------

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
