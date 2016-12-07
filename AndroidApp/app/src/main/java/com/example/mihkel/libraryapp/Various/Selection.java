package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Genre;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.Item.Keyword;
import com.example.mihkel.libraryapp.Item.Language;

import java.util.HashMap;

/**
 * Created by mihkel on 5.12.2016.
 */

public class Selection {
//    HashMap<Integer, Book> books;
//    Integer age;
//    String sex;
//    boolean likesToRead;

    HashMap<Integer, Item> authors = new HashMap<>();
    HashMap<Integer, Item> languages = new HashMap<>();
    HashMap<Integer, Item> keywords = new HashMap<>();
    HashMap<Integer, Item> genres = new HashMap<>();
    boolean isEnglish = false;

    public boolean isEnglish() {
        return isEnglish;
    }

    public void setEnglish(boolean english) {
        isEnglish = english;
    }

    public boolean isEstonian() {
        return isEstonian;
    }

    public void setEstonian(boolean estonian) {
        isEstonian = estonian;
    }

    public boolean isRussian() {
        return isRussian;
    }

    public void setRussian(boolean russian) {
        isRussian = russian;
    }

    boolean isEstonian = false;
    boolean isRussian = false;
    Integer yearFrom;
    Integer yearTo;

    public String toUrlString() {
        return super.toString();
    }

    public HashMap<Integer, Item> getAuthors() {
        return authors;
    }

    public void setAuthors(HashMap<Integer, Item> authors) {
        this.authors = authors;
    }

    public HashMap<Integer, Item> getLanguages() {
        return languages;
    }

    public void setLanguages(HashMap<Integer, Item> languages) {
        this.languages = languages;
    }

    public HashMap<Integer, Item> getKeywords() {
        return keywords;
    }

    public void setKeywords(HashMap<Integer, Item> keywords) {
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

    public HashMap<Integer, Item> getGenres() {
        return genres;
    }

    public void addAuthor(Item author) {
        if (!getAuthors().containsValue(author)) {
            getAuthors().put(author.getId(), author);
        }
    }

    public void addGenre(Item genre) {
        if (!getGenres().containsValue(genre)) {
            getGenres().put(genre.getId(), genre);
        }
    }

    public void addKeyword(Item keyword) {
        if (!getKeywords().containsValue(keyword)) {
            getKeywords().put(keyword.getId(), keyword);
        }
    }

    public void addLanguage(Item language) {
        if (!getLanguages().containsValue(language)) {
            getLanguages().put(language.getId(), language);
        }
    }

    public void removeAuthor(Item author) {
        getAuthors().remove(author);
    }

    public void removeGenre(Item genre) {
       getGenres().remove(genre);
    }

    public void removeKeyword(Keyword keyword) {
       getKeywords().remove(keyword);
    }

    public void removeLanguage(Item language) {
       getLanguages().remove(language);
    }


}
