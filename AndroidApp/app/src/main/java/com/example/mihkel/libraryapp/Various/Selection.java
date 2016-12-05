package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Book;

import java.util.HashMap;

/**
 * Created by mihkel on 5.12.2016.
 */

public class Selection {
    HashMap<Integer, Book> books;
    HashMap<Integer, Author> author;
    HashMap<Integer, String> languages;
    HashMap<Integer, String> keywords;
    Integer age;
    String sex;
    boolean likesToRead;
    Integer yearFrom;
    Integer yearTo;

    public String toUrlString() {
        return super.toString();
    }



}
