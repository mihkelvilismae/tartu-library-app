package com.example.mihkel.libraryapp.Activities;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.AppManagerSingleton;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;

public class BookViewActivity extends AppCompatActivity {

    TextView bookAuthor;
    TextView bookHeading;
    TextView bookYear;
    TextView bookPages;
    TextView bookGenre;
    TextView bookKeyword;
    TextView bookLocation;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_book_view);

        bookAuthor = (TextView) findViewById(R.id.bookAuthor);
        bookHeading = (TextView) findViewById(R.id.bookHeading);
        bookYear = (TextView) findViewById(R.id.bookYear);
        bookPages = (TextView) findViewById(R.id.bookPages);
        bookGenre = (TextView) findViewById(R.id.bookGenre);
        bookKeyword = (TextView) findViewById(R.id.bookKeyword);
        bookLocation = (TextView) findViewById(R.id.bookLocation);

        fillFields();

    }

    public void fillFields() {
        Book selectedBook = DatabaseManagerSingleton.getInstance().getBook(AppManagerSingleton.selectedBookId);
        bookHeading.setText(selectedBook.getName());
        bookAuthor.setText("autoher");
        bookYear.setText("1999");
        bookPages.setText("123");
        bookGenre.setText("ulme");
        bookKeyword.setText("lapsed, jee");
        bookLocation.setText("asukoht");
    }
}
