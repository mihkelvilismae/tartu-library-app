package com.example.mihkel.libraryapp.Item;

import java.util.HashMap;

/**
 * Created by mihkel on 1.11.2016.
 */

public class Book extends Item {
    public Integer year;
    public Integer pages;
    HashMap<Integer, Author> authors;
    HashMap<Integer, Language> languages;
    HashMap<Integer, Keyword> keywords;
    HashMap<Integer, Genre> genres;
//    public String bookLocation;
}
