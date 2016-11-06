package com.example.mihkel.libraryapp.Interfaces;

import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.Item.Clazz;
import com.example.mihkel.libraryapp.Item.School;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by mihkel on 26.10.2016.
 */

public interface DatabaseLayer {

    public Map<Integer, School> getSchools();
    public HashMap<Integer, Clazz> getClasses(Integer schoolId);
    public Map<Integer, Book> getReadingList(Integer classId);
//    public Map<Integer, Author> getAuthors();
}
