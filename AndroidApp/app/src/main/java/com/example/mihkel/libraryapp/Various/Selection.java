package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Genre;
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

    HashMap<Integer, Author> authors;
    HashMap<Integer, Language> languages;
    HashMap<Integer, Keyword> keywords;
    HashMap<Integer, Genre> genres;
    Integer yearFrom;
    Integer yearTo;

    public String toUrlString() {
        return super.toString();
    }

    public HashMap<Integer, Author> getAuthors() {
        return authors;
    }

    public void setAuthors(HashMap<Integer, Author> authors) {
        this.authors = authors;
    }

    public HashMap<Integer, Language> getLanguages() {
        return languages;
    }

    public void setLanguages(HashMap<Integer, Language> languages) {
        this.languages = languages;
    }

    public HashMap<Integer, Keyword> getKeywords() {
        return keywords;
    }

    public void setKeywords(HashMap<Integer, Keyword> keywords) {
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

    public HashMap<Integer, Genre> getGenres() {
        return genres;
    }

    public void addAuthor(Author author) {
        if (!getAuthors().containsValue(author)) {
            getAuthors().put(author.getId(), author);
        }
    }

    public void addGenre(Genre genre) {
        if (!getGenres().containsValue(genre)) {
            getGenres().put(genre.getId(), genre);
        }
    }

    public void addKeyword(Keyword keyword) {
        if (!getKeywords().containsValue(keyword)) {
            getKeywords().put(keyword.getId(), keyword);
        }
    }

    public void addLanguage(Language language) {
        if (!getLanguages().containsValue(language)) {
            getLanguages().put(language.getId(), language);
        }
    }
}
