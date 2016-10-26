package com.example.mihkel.libraryapp;

import java.util.Map;

/**
 * Created by mihkel on 26.10.2016.
 */

public interface DatabaseLayer {

    public Map<Integer, String> getSchools();
    public Map<Integer, String> getClasses(Integer schoolId);
    public Map<Integer, String> getReadingList(Integer classId);
}
