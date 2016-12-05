package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Book;

import java.util.HashMap;

/**
 * Created by mihkel on 5.12.2016.
 */

public class Selection {
//    HashMap<Integer, Book> books;
    HashMap<Integer, Author> author;
    HashMap<Integer, String> languages;
    HashMap<Integer, String> keywords;
//    Integer age;
//    String sex;
//    boolean likesToRead;
    Integer yearFrom;
    Integer yearTo;

    public String toUrlString() {
        return super.toString();
    }

    public HashMap<Integer, Author> getAuthor() {
        return author;
    }

    public void setAuthor(HashMap<Integer, Author> author) {
        this.author = author;
    }

    public HashMap<Integer, String> getLanguages() {
        return languages;
    }

    public void setLanguages(HashMap<Integer, String> languages) {
        this.languages = languages;
    }

    public HashMap<Integer, String> getKeywords() {
        return keywords;
    }

    public void setKeywords(HashMap<Integer, String> keywords) {
        this.keywords = keywords;
    }

    public Integer getYearFrom() {
        return yearFrom;
    }

    public void setYearFrom(Integer yearFrom) {
        this.yearFrom = yearFrom;
    }

    public Integer getYearTo() {
        return yearTo;
    }

    public void setYearTo(Integer yearTo) {
        this.yearTo = yearTo;
    }
}
