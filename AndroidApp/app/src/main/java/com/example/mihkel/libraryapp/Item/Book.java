package com.example.mihkel.libraryapp.Item;

import java.util.HashMap;

/**
 * Created by mihkel on 1.11.2016.
 */

public class Book extends Item {

    public Integer pages;
    String authors;
    String languages;
    String keywords;
    String genres;

    public Integer year;

    public Integer getYear() {
        return year;
    }

    public void setYear(Integer year) {
        this.year = year;
    }

    public Integer getPages() {
        return pages;
    }

    public void setPages(Integer pages) {
        this.pages = pages;
    }

    public String getAuthors() {
        return authors;
    }

    public void setAuthors(String authors) {
        this.authors = authors;
    }

    public String getLanguages() {
        return languages;
    }

    public void setLanguages(String languages) {
        this.languages = languages;
    }

    public String getKeywords() {
        return keywords;
    }

    public void setKeywords(String keywords) {
        this.keywords = keywords;
    }

    public String getGenres() {
        return genres;
    }

    public void setGenres(String genres) {
        this.genres = genres;
    }

//    HashMap<Integer, Author> authors;
//    HashMap<Integer, Language> languages;
//    HashMap<Integer, Keyword> keywords;
//    HashMap<Integer, Genre> genres;

}
