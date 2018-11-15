/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   test.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/13 15:43:52 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 17:19:26 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static int		ft_countwords(char const *s, char c)
{
	int count;

	count = 0;
	while (*s)
	{
		if (*s == c)
			s++;
		else
		{
			count++;
			while (*s && *s != c)
				s++;
		}
	}
	return (count);
}

static size_t	ft_getwordsize(char const *s, char c)
{
	size_t	count;

	count = 0;
	while (*s && *s++ != c)
		count++;
	return (count);
}

char			**strsplittest(char const *s, char c)
{
	char	**tab;
	int		index;
	int		words;
	char	*temp;
	int		i;

	words = ft_countwords(s, c);
	if (!(tab = malloc(sizeof(char *) * words)))
		return (NULL);
	index = 0;
	temp = ft_strdup(s);
	while (index < words)
	{
		temp = ft_strtrim(temp);
		i = 0;
		if (!(tab[index] = ft_strnew(ft_getwordsize(temp, c))))
			return (NULL);
		while (*temp && *temp != c)
			tab[index][i++] = *temp++;
		tab[index++][i] = '\0';
	}
	tab[index] = NULL;
	return (tab);
}

void	ft_print_result(char const *s)
{
	int		len;

	len = 0;
	while (s[len])
		len++;
	write(1, s, len);
}

int		main(void)
{
	char t[1024] = "Lorem ipsum dolor sit met";
	char **tab;
	int i;
	
	i = 0;
	tab = strsplittest(t, 'i');
	while (tab[i] != '\0')
	{
		ft_print_result(tab[i]);
		write(1, "\n", 1);
		i++;
	}
	return (0);
}

